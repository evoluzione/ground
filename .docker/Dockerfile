# WordPress + Apache on PHP 8.3
FROM wordpress:php8.3-apache

# Xdebug (only active "on trigger", see xdebug.ini — no runtime impact).
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# PHP overrides for development (upload, memory, xdebug).
COPY .docker/php/php.ini   /usr/local/etc/php/conf.d/zz-ground.ini
COPY .docker/php/xdebug.ini /usr/local/etc/php/conf.d/zz-xdebug.ini
