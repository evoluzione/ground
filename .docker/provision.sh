#!/usr/bin/env sh
# ---------------------------------------------------------------------------
# Idempotent provisioning of the development WordPress.
# - If the DB is empty: install WP from scratch (fresh install).
# - If it already exists (e.g. imported dump): skip install, only fix URLs + plugins.
# Run by `npm run docker:up` / `docker:provision` via the wpcli service.
# ---------------------------------------------------------------------------
set -e

# Boilerplate base plugins (free, on every site), WooCommerce included.
BASE_PLUGINS="query-monitor wordpress-seo contact-form-7 woocommerce"

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

# WPML + add-ons. Needs WPML_USER_ID and WPML_SUBSCRIPTION_KEY in .env, plus each
# component's "download ID" (from the WPML dashboard → Downloads: the download link
# URL contains download=<ID>). Complete the map below.
# Order matters: WPML core (sitepress) first, then the add-ons that depend on it.
WPML_COMPONENTS="sitepress-multilingual-cms:6088 wpml-string-translation:6092"
# Add more components with their download ID (download=<ID> param in the panel link):
#   acfml:<ID> wpml-seo:<ID> woocommerce-multilingual:<ID>
if [ -n "${WPML_USER_ID:-}" ] && [ -n "${WPML_SUBSCRIPTION_KEY:-}" ]; then
  echo "→ Downloading the WPML stack..."
  for c in $WPML_COMPONENTS; do
    slug="${c%%:*}"; id="${c##*:}"
    case "$id" in *[!0-9]*|"") echo "   • $slug: missing download ID, skipping"; continue ;; esac
    wp plugin install "https://wpml.org/?download=${id}&user_id=${WPML_USER_ID}&subscription_key=${WPML_SUBSCRIPTION_KEY}" --force --activate \
      || echo "   ! $slug: download failed"
  done
else
  echo "   • WPML keys not set: skipping WPML"
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

echo ""
echo "✓ Provisioning complete → $WP_URL"
echo "  Admin: $WP_URL/wp-admin  ($WP_ADMIN_USER / $WP_ADMIN_PASSWORD)"
echo "  Mail:  http://localhost:8025"
