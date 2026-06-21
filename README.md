# Ground

WordPress starter theme with a Docker development environment.

## First install

Requires Docker Desktop running.

1. `cp .env.example .env`
2. In `.env` set the feature toggles and license keys (see [Plugins](#plugins)).
3. `npm run docker:up` — builds, starts and provisions everything.
4. `npm install && npm run dev` — front-end on host (Node 24): Vite + Tailwind + browser-sync.

- Site: <http://localhost:8080> · Admin `/wp-admin` (`admin` / `admin`)
- Test mail (Mailpit): <http://localhost:8025>

> `docker:up` creates `.env` from the example if missing, but edit it **before** the first run so the right plugins get installed.

Commands: `npm run docker:wp -- plugin list`, `npm run docker:shell`, `npm run docker:logs`, `npm run docker:down`, `npm run docker:reset` (wipes DB and WP). Full list: `npm run`.

## Plugins

Provisioning is driven by `.env` — installed once on first `docker:up`.

- **Base** (always, free): Query Monitor, Yoast SEO, Contact Form 7.
- **Toggles**: `ENABLE_WOOCOMMERCE`, `ENABLE_WPML` (`true`/`false`).
- **License keys**: `ACF_PRO_KEY`, `WPML_USER_ID`, `WPML_SUBSCRIPTION_KEY`.

A plugin installs only if it's free or its key is set. WPML add-ons activate by dependency: **WooCommerce Multilingual** (WPML + WooCommerce), **ACF Multilingual** (WPML + ACF key), **CF7 Multilingual** (WPML). To change plugins or add-on versions, edit `.docker/provision.sh`.

## Credits

[Fabio Quarantini](http://www.fabioquarantini.com) · [MIT License](https://opensource.org/licenses/MIT)
