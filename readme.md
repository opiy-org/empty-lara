<p align="center"><img src="https://upload.wikimedia.org/wikipedia/commons/c/c5/Aerial_Photography_UAV_Icon.svg" width="200px"></p>


# DRON Inventory backend


#### dependencies

- php >7.1.3
- postresql
- postgis
- redis


#### installation

```
cp .env.example .env

comopser global require  hirak/prestissimo
composer install
composer dump-autoload

php artisan key:generate

php artisan view:clear && php artisan route:clear && php artisan cache:clear && php artisan config:cache

php artisan migrate --force
php artisan db:seed --force

chown www-data:www-data * -R
chown www-data:www-data .* -R

```
