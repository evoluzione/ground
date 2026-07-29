# Ground

WordPress starter theme with a Docker development environment.

## First install

Requires Docker Desktop running.

1. `cp .env.example .env`
2. In `.env` set the feature toggles and license keys (see [Plugins](#plugins)).
3. Update the Compose project name in `docker-compose.yml` (`name: ground`).
4. If other Ground-based projects already run on this machine, avoid port clashes: in `.env` change `HTTP_PORT` and `MAILPIT_PORT` to ports not already taken (check `docker compose ls` / `docker ps`), and update `WP_URL` to match the new `HTTP_PORT`.
5. `npm run docker:up` — builds images, starts containers, and provisions WordPress/plugins.
6. `npm install && npm run dev` — front-end on host (Node 24): Vite + Tailwind + browser-sync.

- Site: <http://localhost:8080> (or your `HTTP_PORT`) · Admin `/wp-admin` (`admin` / `admin`)
- Test mail (Mailpit): <http://localhost:8025> (or your `MAILPIT_PORT`)

> `docker:up` creates `.env` from the example if missing, but edit it **before** the first run so the right plugins get installed.

> `dev:sync` (browser-sync) reads `HTTP_PORT` from `.env` to proxy the right site, but its own ports (3000 proxy UI, 3001 control panel) aren't configurable per project — only one `npm run dev` can run at a time across all Ground-based projects on this host.

Commands: `npm run docker:wp -- plugin list`, `npm run docker:shell`, `npm run docker:logs`, `npm run docker:down`, `npm run docker:reset` (wipes DB and WP). Full list: `npm run`.

## Plugins

Provisioning is driven by `.env` — installed once on first `docker:up`.

- **Base** (always, free): Query Monitor, Yoast SEO, Contact Form 7.
- **Toggles**: `ENABLE_WOOCOMMERCE`, `ENABLE_WPML` (`true`/`false`).
- **License keys**: `ACF_PRO_KEY`, `WPML_USER_ID`, `WPML_SUBSCRIPTION_KEY`.

A plugin installs only if it's free or its key is set. WPML add-ons activate by dependency: **WooCommerce Multilingual** (WPML + WooCommerce), **ACF Multilingual** (WPML + ACF key), **CF7 Multilingual** (WPML). To change plugins or add-on versions, edit `.docker/provision.sh`.

## wp-config

There's no `wp-config.php` in the repo. Extra constants (`WP_DEBUG_LOG`, `WP_ENVIRONMENT_TYPE`, etc.) live in the `x-wp-config-extra` anchor in `docker-compose.yml`. To change one, edit that anchor and run `npm run docker:down && npm run docker:up` (data is preserved — only `docker:reset` wipes volumes).

## Credits

[Fabio Quarantini](http://www.fabioquarantini.com) · [MIT License](https://opensource.org/licenses/MIT)
