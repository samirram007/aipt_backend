#!/bin/sh
set -e

cd /var/www/html/patho/backend

if [ ! -f storage/logs/.gitignore ]; then
    mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs
fi

php artisan storage:link --force || true

if [ -d /var/www/html/patho/backend/public-shared ]; then
    cp -a /var/www/html/patho/backend/public/. /var/www/html/patho/backend/public-shared/
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache

if [ "$RUN_MIGRATIONS" = "true" ]; then
    php artisan migrate --force
fi

exec "$@"
