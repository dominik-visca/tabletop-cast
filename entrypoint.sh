#!/bin/sh

echo "Running entrypoint script..."

echo "Set application key"
php artisan key:generate

echo "Set permissions"
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "Run Laravel optimizations"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Run database migrations"
php artisan migrate --force

echo "Run any seeders (optional)"
php artisan db:seed --force

echo "Finished!"
exec "$@"
