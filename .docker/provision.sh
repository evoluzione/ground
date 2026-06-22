#!/usr/bin/env sh
# ---------------------------------------------------------------------------
# Idempotent provisioning of the development WordPress.
# - If the DB is empty: install WP from scratch (fresh install).
# - If it already exists (e.g. imported dump): skip install, only fix URLs + plugins.
# Run by `npm run docker:up` / `docker:provision` via the wpcli service.
# ---------------------------------------------------------------------------
set -e

# Truthy check for the ENABLE_* feature toggles (true/1/yes/on, case-insensitive).
is_on() { case "$(echo "${1:-}" | tr 'A-Z' 'a-z')" in 1|true|yes|on) return 0 ;; *) return 1 ;; esac; }

# Boilerplate base plugins (free, on every site).
BASE_PLUGINS="query-monitor wordpress-seo contact-form-7 webp-uploads"

# WooCommerce is free but opt-in per project, via ENABLE_WOOCOMMERCE.
if is_on "$ENABLE_WOOCOMMERCE"; then
  BASE_PLUGINS="$BASE_PLUGINS woocommerce"
fi

# PREMIUM plugins (ACF Pro + WPML stack) are downloaded with the license keys
# from .env — see below (.zip files in .docker/plugins/ remain as a fallback).

echo "→ Waiting for wp-config.php..."
until [ -f /var/www/html/wp-config.php ]; do sleep 2; done

echo "→ Waiting for the database..."
until wp db check >/dev/null 2>&1; do sleep 3; done

if wp core is-installed >/dev/null 2>&1; then
  echo "→ WordPress already installed: skipping core install."
else
  echo "→ Installing WordPress (fresh)..."
  wp core install \
    --url="$WP_URL" \
    --title="$WP_TITLE" \
    --admin_user="$WP_ADMIN_USER" \
    --admin_password="$WP_ADMIN_PASSWORD" \
    --admin_email="$WP_ADMIN_EMAIL" \
    --skip-email
  wp language core install it_IT --activate || true
  wp option update timezone_string 'Europe/Rome' || true
  wp option update blogdescription 'Ground starter' || true
fi

# Always align the URLs (also useful after importing a dump).
wp option update home "$WP_URL"
wp option update siteurl "$WP_URL"

# Remove WordPress default plugins.
wp plugin delete akismet hello >/dev/null 2>&1 || true

echo "→ Installing and activating free plugins..."
for p in $BASE_PLUGINS; do
  wp plugin is-installed "$p" >/dev/null 2>&1 || wp plugin install "$p" || { echo "   ! install of $p failed"; continue; }
  wp plugin activate "$p" >/dev/null 2>&1 && echo "   • $p active" || echo "   ! $p not activated"
done

# --- PREMIUM plugins via license keys (authenticated download) ---
# Keys live in .env (gitignored). If missing, the block is skipped.

# ACF Pro — direct download with the license key (same URL as the ACF panel).
if [ -n "${ACF_PRO_KEY:-}" ]; then
  echo "→ Downloading ACF Pro with the license key..."
  wp plugin install "https://connect.advancedcustomfields.com/v2/plugins/download?s=web&p=pro&k=${ACF_PRO_KEY}" --force --activate \
    || echo "   ! ACF Pro: download failed (check ACF_PRO_KEY)"
else
  echo "   • ACF_PRO_KEY not set: ACF Pro expected from .docker/plugins/"
fi

# WPML stack. Needs WPML_USER_ID + WPML_SUBSCRIPTION_KEY in .env, plus a "download
# ID" per component (the download=<ID> param in the WPML dashboard → Downloads link).
# NB: the add-on IDs are VERSION-PINNED — refresh them from the panel after a WPML
# update, or the download fails ("! <slug>: download failed").
WPML_ID_SITEPRESS=6088    # WPML Multilingual CMS (core)
WPML_ID_STRING=6092       # String Translation
WPML_ID_WCML=637370       # WooCommerce Multilingual & Multicurrency
WPML_ID_CF7=3156699       # Contact Form 7 Multilingual
WPML_ID_ACFML=1097589     # Advanced Custom Fields Multilingual

# Build the install list. Order matters: core first, then add-ons, each gated by its
# dependency — WCML: WooCommerce+WPML · CF7ML: WPML · ACFML: WPML+ACF key.
WPML_COMPONENTS="sitepress-multilingual-cms:${WPML_ID_SITEPRESS} wpml-string-translation:${WPML_ID_STRING}"
if is_on "$ENABLE_WOOCOMMERCE" && is_on "$ENABLE_WPML"; then
  WPML_COMPONENTS="$WPML_COMPONENTS woocommerce-multilingual:${WPML_ID_WCML}"
fi
if is_on "$ENABLE_WPML"; then
  WPML_COMPONENTS="$WPML_COMPONENTS contact-form-7-multilingual:${WPML_ID_CF7}"
fi
if is_on "$ENABLE_WPML" && [ -n "${ACF_PRO_KEY:-}" ]; then
  WPML_COMPONENTS="$WPML_COMPONENTS acfml:${WPML_ID_ACFML}"
fi
if is_on "$ENABLE_WPML" && [ -n "${WPML_USER_ID:-}" ] && [ -n "${WPML_SUBSCRIPTION_KEY:-}" ]; then
  echo "→ Downloading the WPML stack..."
  for c in $WPML_COMPONENTS; do
    slug="${c%%:*}"; id="${c##*:}"
    case "$id" in *[!0-9]*|"") echo "   • $slug: missing download ID, skipping"; continue ;; esac
    wp plugin install "https://wpml.org/?download=${id}&user_id=${WPML_USER_ID}&subscription_key=${WPML_SUBSCRIPTION_KEY}" --force --activate \
      || echo "   ! $slug: download failed"
  done
else
  echo "   • WPML off (ENABLE_WPML) or keys not set: skipping WPML"
fi

# Optional fallback: any .zip manually placed in .docker/plugins/.
if ls /plugins/*.zip >/dev/null 2>&1; then
  echo "→ Installing any .zip in plugins/..."
  for zip in /plugins/*.zip; do
    wp plugin install "$zip" --force --activate || echo "   ! error on $zip"
  done
fi

echo "→ Activating the 'ground' theme..."
wp theme activate ground || echo "   ! theme not activated (assets build done?)"

# Pretty permalinks (--hard rewrites .htaccess); flush after theme+plugins are active.
echo "→ Setting permalinks (/%postname%/)..."
wp rewrite structure '/%postname%/' --hard >/dev/null 2>&1 || echo "   ! permalinks not set"

# --- ACF: sync local JSON field groups into the database ---
# The theme registers the load point (inc/extend.php), so the groups already work
# at runtime; this also materializes them in the DB (editable in admin, no "sync"
# notice). Needs the theme active (load point) AND ACF Pro >= 6.8 (json sync cmd).
if wp acf json sync --dry-run >/dev/null 2>&1; then
  echo "→ Syncing ACF local JSON to the database..."
  wp acf json sync >/dev/null 2>&1 && echo "   • ACF field groups synced" || echo "   ! ACF sync failed"
else
  echo "   • ACF JSON sync unavailable (ACF Pro <6.8 or inactive): groups still load via load_json"
fi

# --- Seed demo content (opt-in via ENABLE_SEED, runs once) ---
if is_on "$ENABLE_SEED"; then
  if [ "$(wp option get ground_seed_done 2>/dev/null)" = "1" ]; then
    echo "   • demo content already seeded: skipping (delete option 'ground_seed_done' to re-run)"
  else
    echo "→ Seeding demo content..."

    # 1) Official test data via the WordPress importer, imported FIRST so seed.php
    #    can reference it (reuse "Front Page"/"a Blog page", build the "Esempi"
    #    submenu). Sources:
    #      - vendored XML in .docker/seed/ (Gutenberg blocks + classic edge cases)
    #      - WooCommerce's own sample_products.xml (fills the Shop) when Woo is on
    #    The importer is only needed here: install, use, then deactivate.
    WC_SAMPLE="/var/www/html/wp-content/plugins/woocommerce/sample-data/sample_products.xml"
    if ls /docker-scripts/seed/*.xml >/dev/null 2>&1 || { is_on "$ENABLE_WOOCOMMERCE" && [ -f "$WC_SAMPLE" ]; }; then
      wp plugin install wordpress-importer --activate >/dev/null 2>&1 || echo "   ! wordpress-importer install failed"
      for xml in /docker-scripts/seed/*.xml; do
        [ -f "$xml" ] || continue
        echo "   • importing $(basename "$xml")..."
        wp import "$xml" --authors=create >/dev/null 2>&1 || echo "   ! import of $(basename "$xml") failed"
      done
      if is_on "$ENABLE_WOOCOMMERCE" && [ -f "$WC_SAMPLE" ]; then
        echo "   • importing sample_products.xml (WooCommerce)..."
        wp import "$WC_SAMPLE" --authors=create >/dev/null 2>&1 || echo "   ! import of sample_products.xml failed"
      fi
      wp plugin deactivate wordpress-importer >/dev/null 2>&1 || true
    fi

    # 2) Theme-specific fixtures: catalog CPT, taxonomy + ACF image, scaffold pages,
    #    nav menus, ACF block demo. All tagged with meta _ground_seed.
    wp eval-file /docker-scripts/seed.php || echo "   ! seed.php failed"

    wp option update ground_seed_done 1 >/dev/null 2>&1
    echo "   • seeding complete"
  fi
else
  echo "   • ENABLE_SEED off: skipping demo content"
fi

echo ""
echo "✓ Provisioning complete → $WP_URL"
echo "  Admin: $WP_URL/wp-admin  ($WP_ADMIN_USER / $WP_ADMIN_PASSWORD)"
echo "  Mail:  http://localhost:8025"
