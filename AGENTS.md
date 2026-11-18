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

Standard WP template hierarchy at the theme root (`index.php`, `page.php`, `front-page.php`, `single-post.php`, `single-ground_catalog.php`, `category.php`, `taxonomy-ground_catalog_taxonomy.php`, `woocommerce.php`) delegates immediately to `template-parts/` via `get_template_part()`. Naming convention: `template-parts/{header,footer,content,preview,navigation,pagination,sidebar,loop,blocks,cart}/{type}-{name}.php`. Full-page layouts (e.g. `templates/template-ground_catalog.php`, selected as a WP page template) compose these parts directly rather than duplicating markup.

**Markup lives in template parts, not next to the functions in `inc/`.** `inc/` holds logic (hooks, filters, registration loops); when it has to render something — e.g. the WooCommerce AJAX fragments — it calls `get_template_part()` on the same part the page uses, so markup and its Tailwind classes have one home. The navigation helpers in `inc/utilities.php` return data only and the part writes the markup: `ground_breadcrumbs()` (Yoast's crumbs), `ground_pagination()` (the links of `paginate_links()`), `ground_menu()`, `ground_subpages()` and `ground_terms()` (trees of items with `title`, `url`, `current`, `ancestor`, `children`). A part renders a tree with one `foreach` per level it shows, prints each link's attributes with `ground_link_attributes()` and styles the current one with the `current:` variant (`aria-current="page"`, defined in `src/css/app.css`). Menus don't go through `wp_nav_menu()`: `ground_menu()` runs its steps up to the walker (items, current/ancestor detection, the `wp_nav_menu_objects` filter), so whatever hooks the walker or its HTML (`nav_menu_css_class`, `nav_menu_link_attributes`, `wp_nav_menu_items`) doesn't apply. An item's `ancestor` marks the section the visitor is in: a parent of the current item in the menu, a page or term the content descends from, or the page listing that kind of content (`ground_listing_url()`: the posts page, the shop, a post type's archive or, without one, the page using `templates/template-{post_type}.php`). The main menu's submenus open on hover in CSS and, from the keyboard, through a button next to the parent link whose `aria-expanded` is driven by `src/js/components/submenu.js`. `ground_image()` and `ground_icon()` output a single element and take its classes from the caller's args.

### The catalog CPT (`ground_catalog`)

A generic products/listing custom post type + hierarchical taxonomy (`ground_catalog_taxonomy`), registered via `config/post-types.php`, independent of WooCommerce. `config/catalog.php` controls its listing behavior (`mode`: `products` vs `auto` category-then-products drilldown, `per_page`). Rendered through `template-parts/loop/loop-ground_catalog.php`, invoked with explicit args (`mode`, `parent`, `per_page`) rather than reading config inside the loop part itself.

### WooCommerce integration ([inc/woocommerce.php](inc/woocommerce.php))

Opt-in via `ENABLE_WOOCOMMERCE`. Key points if touching commerce code:

- [woocommerce.php](woocommerce.php) at the theme root is WooCommerce's own main-template override — it assembles the shop/product page (header → `woocommerce_content()` → footer) and conditionally renders the filters sidebar (`is_shop() || is_product_taxonomy()`), same pattern as the other root templates in Template routing above.
- The **"Shop filters"** sidebar (`sidebar-shop`, registered in `config/sidebars.php` like any other sidebar) is rendered via `template-parts/sidebar/sidebar-shop.php` and populated with WooCommerce's own widgets (layered nav, price filter, categories) during provisioning when seeding is on.
- WooCommerce's own frontend stylesheets are dequeued (`woocommerce_enqueue_styles` → `__return_empty_array`) because they're unlayered CSS that would beat Tailwind's `@layer utilities` output regardless of specificity — the theme owns all WooCommerce markup styling in `src/css/woocommerce/` instead.
- Product image sizes are centralized in `config/media.php` (the `woocommerce_*` keys of `media.sizes`) and enforced via `woocommerce_get_image_size_{name}` filters, not left store-owner-editable.
- Header cart markup lives in `template-parts/cart/`: `cart-link.php` (trigger + badge), `cart-drawer.php` (the `<dialog>` drawer, opened by `src/js/components/miniCart.js`) and `cart-drawer-content.php` (what's inside it). The trigger and the drawer contents are also AJAX fragments (`woocommerce_add_to_cart_fragments`), re-rendered standalone on every cart update from the same parts — keep them self-contained. WooCommerce's own mini-cart markup inside is styled in `src/css/woocommerce/minicart.css`.
- `woocommerce/` at the theme root holds WooCommerce template part overrides (WC's own override mechanism for parts like the product loop, separate from `template-parts/`).

### Assets pipeline

Two independent build tools, both outputting into `assets/` (git-ignored build output, not source):

- **CSS**: Tailwind v4 CLI compiles `src/css/app.css` → `assets/css/ground-styles.min.css`. Markup the theme renders carries Tailwind utilities in place; only markup it doesn't own (WooCommerce's) is styled by selector with `@apply`, one file per component in `src/css/woocommerce/`, imported by `app.css`.
- **JS**: Vite (`vite.config.js`, using `rolldownOptions`) bundles `src/js/app.js` → `assets/js/ground-scripts.min.js`, with dynamic-imported chunks (e.g. `utilities/toggle.js` is only loaded when `.js-toggle` exists in the DOM — follow this lazy-import pattern for optional JS behaviors).
- `browser-sync` proxies `localhost:8080` and reloads on CSS/PHP/JS changes — this is what `npm run dev` drives alongside the two watchers.
- Both are registered/enqueued through `config/assets.php`, not `wp_enqueue_*` calls in template code.

### Images

- `config/media.php` (`media.sizes`) holds the four core slots at WordPress defaults plus **cropped families named by ratio and step** (`1-1-small`, `16-9-large`…): one family per ratio the design uses, one step per real box at the Lighthouse presets (412×1.75, 1350×1) plus the 2x. Core registers `1536x1536`/`2048x2048` itself.
- Cropping happens on the server. A template requests the step closest to its box (`size`) and **always passes `attr['sizes']`** with the real box width per breakpoint: WordPress builds the srcset from the whole family (every subsize with the same ratio), and its default `sizes` would pick a file far too large. `aspect-* object-cover` classes stay as a visual safety net for uploads too small to be cropped.
- A ratio that changes per breakpoint is a hand-written `<picture>`: a `<source>` with `wp_get_attachment_image_srcset( $id, '16-9-large' )` and its own `sizes`, then `ground_image()` with the mobile family as the `<img>`.
- `ground_image()` is a thin wrapper over `wp_get_attachment_image()` / `get_the_post_thumbnail()`: it never computes ratios, rewrites `sizes` or forces `loading` (core decides eager/lazy and `fetchpriority`).
- The editor's images (Image, Gallery, Featured Image blocks…) keep core's `sizes`, as in WordPress's default themes: `(max-width: Wpx) 100vw, Wpx` from the file width, `auto` first when lazy. Lazy images and mobile (100vw ≈ the column) get the right file; only the first, eager ones on desktop download a file wider than the column. The Featured Image block asks for `post-thumbnail`, left unregistered on purpose: it resolves to the original (capped at 2560px by core) and the srcset does the rest. A project with one content column can close the desktop gap with a `wp_calculate_image_sizes` filter returning that column's `sizes` for images at least as wide as the column.
- Regenerate with `npm run docker:wp -- media regenerate --yes`. The `wpcli` image is built from the same `.docker/Dockerfile` as `wordpress` (target `wpcli`), so CLI and uploads share PHP and Imagick: the stock Alpine `wordpress:cli` image has no JPEG/WebP delegates, falls back to GD and writes heavier WebP files. After editing the Dockerfile, rebuild both with `docker compose --profile tools build`.

### ACF

Field groups are local JSON, saved/loaded from `config/acf/` (redirected via the `acf/settings/save_json` / `acf/settings/load_json` filters in [inc/extend.php](inc/extend.php)) instead of the default `acf-json` folder — keep field group edits inside `config/acf/`.

ACF blocks are registered from `config/blocks.php` through `acf_register_block_type()` (not `block.json`: every `block.json` `acf` key has a snake_case PHP equivalent, e.g. `auto_inline_editing`, `hide_fields_in_sidebar`, `render_preview`). The loop in [inc/gutenberg.php](inc/gutenberg.php) defaults each block to **ACF Blocks v3 + Block API 3** (always a live preview, no edit/preview modes, iframe-ready) and to the template `template-parts/blocks/{name}.php`. Templates open their wrapper with `ground_block_attributes( $block, $class, $is_preview )`: on the frontend it delegates to `get_block_wrapper_attributes()` (block supports, anchor, align), in the editor it prints only the theme's classes because the editor's own wrapper already carries the supports.

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
