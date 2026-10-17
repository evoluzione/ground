# WordPress + Apache on PHP 8.3
FROM wordpress:php8.3-apache AS wordpress

# Xdebug (only active "on trigger", see xdebug.ini — no runtime impact).
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# PHP overrides for development (upload, memory, xdebug).
COPY .docker/php/php.ini   /usr/local/etc/php/conf.d/zz-ground.ini
COPY .docker/php/xdebug.ini /usr/local/etc/php/conf.d/zz-xdebug.ini

# ---------------------------------------------------------------------------
# WP-CLI on the SAME PHP/Imagick as the web container, so `wp media regenerate`
# writes the same files a real upload does. The official wordpress:cli image is
# Alpine with a different ImageMagick and no JPEG/WebP delegates: WordPress
# falls back to GD there and the WebP subsizes come out heavier.
# ---------------------------------------------------------------------------
FROM wordpress AS wpcli

ARG WP_CLI_VERSION=2.12.0

# mariadb-client: `wp db *` commands; less: WP-CLI pager.
RUN apt-get update \
    && apt-get install -y --no-install-recommends mariadb-client less \
    && rm -rf /var/lib/apt/lists/* \
    && curl -fsSL -o /usr/local/bin/wp \
       "https://github.com/wp-cli/wp-cli/releases/download/v${WP_CLI_VERSION}/wp-cli-${WP_CLI_VERSION}.phar" \
    && chmod +x /usr/local/bin/wp \
    && wp --allow-root --version

WORKDIR /var/www/html
ENTRYPOINT []
CMD ["wp", "shell"]
