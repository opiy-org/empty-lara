#!/usr/bin/env bash
cd /var/www/dron-inventory-back
git fetch
git stash
git pull
composer install
composer dump-autoload
php artisan migrate --force
php artisan db:seed --force
php artisan view:clear && php artisan route:clear && php artisan cache:clear && php artisan config:cache
chown www-data:www-data * -R
chown www-data:www-data .* -R