# Ground — project instructions

WordPress starter theme. Local development runs via Docker: `npm run docker:up` → http://localhost:8080
(mail at http://localhost:8025).

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
