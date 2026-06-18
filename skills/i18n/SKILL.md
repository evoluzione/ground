---
name: i18n
description: Translate strings for the Ground WordPress theme (text domain `ground`). Use this skill when a translatable string is added or changed in PHP, when the `.pot`/`.po`/`.mo` files need regenerating, or when the user asks to translate the theme or update translations. Runs the Docker-based extract → translate → compile → verify flow.
---

# i18n — Ground theme translation flow

Text domain: **`ground`**. Default language **English** (source strings are in
English, so there is no `en` file). Active translated locale: **`it_IT`** (set via
`WPLANG` in `docker-compose.yml`). The whole toolchain runs through WP-CLI in the
`wpcli` container — no `gettext` dependency on the host.

Files in `languages/`:
- `ground.pot` — template, `msgid` only (do NOT edit by hand).
- `ground-<locale>.po` — editable translations.
- `ground-<locale>.mo` — compiled binary, this is what WordPress loads at runtime.

## Strings in code
Always use the WP i18n functions with the `ground` text domain:
```php
esc_html_e( 'Text', 'ground' );
$x = __( 'Text', 'ground' );
```

## Procedure

Run the steps in order (the i18n commands do not need confirmation).

1. **Extract and sync** the template and all `.po` files (existing translations are
   preserved, new entries are added with `msgstr ""`):
   ```bash
   npm run i18n:extract
   ```
2. **Translate** every empty `msgstr ""` left in `languages/ground-it_IT.po`
   (and in any other `ground-<locale>.po`). Conventions:
   - `Header`/`Footer` stay as-is: translate only the qualifier
     (`Footer primary` → `Footer primario`).
   - Proper nouns / brand terms (`Ground`, `Starter`) stay unchanged.
   - Preserve the `msgid` spacing and punctuation EXACTLY (including trailing spaces).
3. **Compile** every `.po` into `.mo`:
   ```bash
   npm run i18n:compile
   ```
4. **Verify** that translations resolve:
   ```bash
   docker compose run --rm -w /var/www/html/wp-content/themes/ground wpcli \
     wp eval 'load_textdomain("ground","languages/ground-it_IT.mo","it_IT");
              echo __("Catalog","ground");'
   ```

## Adding a new locale (e.g. `fr_FR`)
Copy `ground.pot` to `languages/ground-fr_FR.po`, set the `Language: fr_FR` and
`Plural-Forms` headers, then run the procedure from step 2. `i18n:extract` and
`i18n:compile` automatically include any new `.po` file.

## Reference npm scripts (defined in package.json)
- `i18n:pot` — regenerate `ground.pot` (make-pot).
- `i18n:update` — merge `.pot` → all `.po` files, preserving translations (update-po).
- `i18n:extract` — `i18n:pot` + `i18n:update`.
- `i18n:compile` — compile all `.po` files into `.mo` (make-mo).
