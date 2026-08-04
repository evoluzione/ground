# Ground — project instructions

This file provides guidance when working with code in this repository.

## What this is

**Ground** is a WordPress starter/boilerplate theme (text domain `ground`) built for front-end developers, with a full Docker-based local dev environment. It is not a single-site build — it's a reusable base other projects are started from, so changes should stay generic/config-driven rather than site-specific.

## Local development

Requires Docker Desktop. First-time setup: `cp .env.example .env`, edit `.env` (feature toggles + license keys), then:

```bash
npm run docker:up
```

This builds/starts containers and provisions WordPress + plugins (idempotent — safe to re-run). Site: `http://localhost:8080` (`admin`/`admin`), Mailpit (catches all outgoing mail): `http://localhost:8025`.

Front-end tooling runs on the **host**, not in Docker (Node version pinned in `.nvmrc`): `npm install && npm run dev` starts Vite + Tailwind v4 CLI + browser-sync, all watching.

### Other commands

```bash
npm run docker:wp -- <command>   # any wp-cli command, e.g. npm run docker:wp -- plugin list
npm run docker:shell             # bash inside the wordpress container
npm run docker:logs              # tail wordpress container logs
npm run docker:down              # stop containers
npm run docker:reset             # stop AND wipe the DB/WP volumes (destructive)
npm run docker:seed              # re-run provisioning with ENABLE_SEED=true (imports demo fixtures)
npm run build                    # production JS + CSS build
```

There are no automated PHP/JS tests in this repo; validate changes by loading the theme on the Docker site and via `npm run lint` / `format:check`.

## Provisioning (`.docker/provision.sh`)

Idempotent: installs WordPress fresh only if the DB is empty, otherwise just realigns URLs/plugins. Driven entirely by `.env`:

- **Base plugins** (always, free): Query Monitor, Yoast SEO, Contact Form 7, WebP Uploads, FluentSMTP.
- **Toggles**: `ENABLE_WOOCOMMERCE`, `ENABLE_WPML` (a plugin installs only if its toggle is on AND it's free or its license key is set). WPML add-ons (WooCommerce Multilingual, ACF Multilingual, CF7 Multilingual) activate automatically by dependency.
- **`ENABLE_SEED`**: imports the theme's own demo fixtures (`.docker/seed.php` — catalog products/taxonomy/menus/front page) plus official WP core/theme test data (`.docker/seed/*.xml`), guarded by a one-time `ground_seed_done` option. `.docker/seed-reset.php` reverses it.
- To change which plugins/versions get installed, edit `.docker/provision.sh` directly.

## Architecture

### Config-driven bootstrapping

Nearly every WordPress registration (post types/taxonomies, menus, sidebars, image sizes, enqueued assets, ACF blocks) is **not** hardcoded in PHP — it's declarative data in `config/*.php` (each file `return`s a plain array), read through a single accessor:

```php
ground_config( 'post-types.post_types' )   // 'post-types' → config/post-types.php, then ['post_types'] key
```

`ground_config()` (in [inc/utilities.php](inc/utilities.php)) memoizes each config file on first read. The registration loops themselves live in [inc/theme-support.php](inc/theme-support.php) (post types/taxonomies, menus, sidebars, image sizes), [inc/head-output.php](inc/head-output.php) (styles/scripts), and [inc/gutenberg.php](inc/gutenberg.php) (ACF blocks). **To add a post type, menu, sidebar, image size, or enqueued asset, edit the relevant `config/*.php` array — don't add new `register_*`/`wp_enqueue_*` calls elsewhere.**

`functions.php` just requires, in order: `constants` → `utilities` → `theme-support` → `woocommerce` → `head-output` → `extend` → `gutenberg`.

### Template routing

Standard WP template hierarchy at the theme root (`index.php`, `page.php`, `front-page.php`, `single-post.php`, `single-ground_catalog.php`, `category.php`, `taxonomy-ground_catalog_taxonomy.php`, `woocommerce.php`) delegates immediately to `template-parts/` via `get_template_part()`. Naming convention: `template-parts/{header,footer,content,preview,navigation,pagination,sidebar,loop,blocks}/{type}-{name}.php`. Full-page layouts (e.g. `templates/template-ground_catalog.php`, selected as a WP page template) compose these parts directly rather than duplicating markup.

### The catalog CPT (`ground_catalog`)

A generic products/listing custom post type + hierarchical taxonomy (`ground_catalog_taxonomy`), registered via `config/post-types.php`, independent of WooCommerce. `config/catalog.php` controls its listing behavior (`mode`: `products` vs `auto` category-then-products drilldown, `per_page`). Rendered through `template-parts/loop/loop-ground_catalog.php`, invoked with explicit args (`mode`, `parent`, `per_page`) rather than reading config inside the loop part itself.

### WooCommerce integration ([inc/woocommerce.php](inc/woocommerce.php))

Opt-in via `ENABLE_WOOCOMMERCE`. Key points if touching commerce code:

- [woocommerce.php](woocommerce.php) at the theme root is WooCommerce's own main-template override — it assembles the shop/product page (header → `woocommerce_content()` → footer) and conditionally renders the filters sidebar (`is_shop() || is_product_taxonomy()`), same pattern as the other root templates in Template routing above.
- The **"Shop filters"** sidebar (`sidebar-shop`, registered in `config/sidebars.php` like any other sidebar) is rendered via `template-parts/sidebar/sidebar-shop.php` and populated with WooCommerce's own widgets (layered nav, price filter, categories) during provisioning when seeding is on.
- WooCommerce's own frontend stylesheets are dequeued (`woocommerce_enqueue_styles` → `__return_empty_array`) because they're unlayered CSS that would beat Tailwind's `@layer utilities` output regardless of specificity — the theme owns all WooCommerce markup styling in `src/css/app.css` instead.
- Product image sizes are centralized in `config/media.php` (`media.woocommerce`) and enforced via `woocommerce_get_image_size_{name}` filters, not left store-owner-editable.
- Mini-cart / header cart badge are AJAX fragments (`woocommerce_add_to_cart_fragments`) keyed to selectors in `content-header-primary.php` — keep `ground_cart_link()` self-contained since it's re-rendered standalone on every cart update.
- `woocommerce/` at the theme root holds WooCommerce template part overrides (WC's own override mechanism for parts like the product loop, separate from `template-parts/`).

### Assets pipeline

Two independent build tools, both outputting into `assets/` (git-ignored build output, not source):

- **CSS**: Tailwind v4 CLI compiles `src/css/app.css` → `assets/css/ground-styles.min.css`.
- **JS**: Vite (`vite.config.js`, using `rolldownOptions`) bundles `src/js/app.js` → `assets/js/ground-scripts.min.js`, with dynamic-imported chunks (e.g. `utilities/toggle.js` is only loaded when `.js-toggle` exists in the DOM — follow this lazy-import pattern for optional JS behaviors).
- `browser-sync` proxies `localhost:8080` and reloads on CSS/PHP/JS changes — this is what `npm run dev` drives alongside the two watchers.
- Both are registered/enqueued through `config/assets.php`, not `wp_enqueue_*` calls in template code.

### ACF

Field groups are local JSON, saved/loaded from `config/acf/` (redirected via the `acf/settings/save_json` / `acf/settings/load_json` filters in [inc/extend.php](inc/extend.php)) instead of the default `acf-json` folder — keep field group edits inside `config/acf/`.

## Code style

- PHP: WordPress coding style (tabs, existing file conventions); `.vscode/settings.json` sets `php.format.codeStyle: WordPress` and format-on-save.
- JS: ESLint flat config (`eslint.config.js`) scoped to `src/js/**/*.js`; Prettier owns formatting (ESLint's stylistic rules are disabled last via `eslint-config-prettier`).

## Always-on rules

- **WP-CLI lives only in the `wpcli` container**: every `wp` command goes through
  `docker compose run --rm wpcli wp …`. Never invoke `wp` on the host.
- Assets: `npm run dev` (watch) / `npm run build` — Tailwind v4 + Vite.
- Lint/format: `npm run lint`, `npm run format`.

## i18n

- Text domain **`ground`**. Default language **English** (no `en` file). Translated
  locale: **`it_IT`** (set via `WPLANG` in `docker-compose.yml`).
- `languages/`: `ground.pot` (template, do not edit by hand), `ground-<locale>.po`
  (editable), `ground-<locale>.mo` (compiled, loaded by WordPress).
- To add or translate strings, follow the **i18n** skill (`skills/i18n/SKILL.md`):
  `i18n:extract` → translate the empty `msgstr` entries → `i18n:compile`.
