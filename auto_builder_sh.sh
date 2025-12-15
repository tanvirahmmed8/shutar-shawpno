
composer update
cp .env.example .env
php artisan key:generate
php artisan passport:keys

chmod -R 775 storage/framework

# php artisan db:seed --force // we cant beacuse database is not configured yet

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize:clear
