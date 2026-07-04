# syntax=docker/dockerfile:1

ARG PHP_VERSION=8.4

# ---------------------------------------------------------------------------
# Stage: PHP dependencies (composer install)
# ---------------------------------------------------------------------------
FROM php:${PHP_VERSION}-fpm-alpine AS vendor

RUN apk add --no-cache git unzip \
    && curl -sS https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions -o /usr/local/bin/install-php-extensions \
    && chmod +x /usr/local/bin/install-php-extensions \
    && install-php-extensions pdo_mysql bcmath gd intl zip opcache pcntl redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/patho/backend

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-scripts --no-autoloader --prefer-dist

COPY . .

RUN composer dump-autoload --optimize --no-dev --classmap-authoritative

# ---------------------------------------------------------------------------
# Stage: production runtime image
# ---------------------------------------------------------------------------
FROM php:${PHP_VERSION}-fpm-alpine AS app

RUN apk add --no-cache curl \
    && curl -sS https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions -o /usr/local/bin/install-php-extensions \
    && chmod +x /usr/local/bin/install-php-extensions \
    && install-php-extensions pdo_mysql bcmath gd intl zip opcache pcntl redis \
    && apk del curl \
    && rm -rf /var/cache/apk/*

WORKDIR /var/www/html/patho/backend

COPY docker/production/php/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY docker/production/php/www.conf /usr/local/etc/php-fpm.d/zz-app.conf
COPY docker/production/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

COPY --from=vendor /var/www/html/patho/backend /var/www/html/patho/backend

RUN addgroup -g 1000 app \
    && adduser -G app -u 1000 -D app \
    && mkdir -p /var/www/html/patho/backend/public \
    && chown -R app:app /var/www/html/patho/backend \
    && chmod -R 775 /var/www/html/patho/backend/storage /var/www/html/patho/backend/bootstrap/cache

USER app

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
