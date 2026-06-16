# Ground

WordPress starter theme with a Docker development environment.

## Development

Requires Docker Desktop running.

```bash
npm run docker:up             # starts WordPress + DB + plugins + theme (creates .env if missing)
npm install && npm run dev    # front-end on host (Node 24): Vite + Tailwind + browser-sync
```

- Site: <http://localhost:8080> · Admin `/wp-admin` (`admin` / `admin`)
- Test mail (Mailpit): <http://localhost:8025>

Commands: `npm run docker:wp -- plugin list`, `npm run docker:shell`, `npm run docker:logs`, `npm run docker:down`, `npm run docker:reset` (wipes DB and WP). Full list: `npm run`.

## Plugins

- **Base** (auto, free): Query Monitor, Yoast SEO, Contact Form 7, WooCommerce — list at the top of `.docker/provision.sh`.
- **Premium** (ACF Pro, WPML): put the license keys in `.env`. ⚠️ The WPML key contains `$`: wrap it in **single quotes** → `WPML_SUBSCRIPTION_KEY='$P$...'`.

## Credits

[Fabio Quarantini](http://www.fabioquarantini.com) · [MIT License](https://opensource.org/licenses/MIT)
