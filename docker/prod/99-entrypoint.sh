#!/bin/bash
set -e

echo "🚀 Starting entrypoint script..."

# Create necessary directories and set permissions
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/framework/{cache,sessions,views}
mkdir -p /var/www/html/bootstrap/cache

# Flag file to track first run
FIRST_RUN_FLAG="/var/www/html/storage/app/flags/first_run_completed"

# Wait for database
echo "⏳ Waiting for database connection..."
until PGPASSWORD=$DB_PASSWORD psql -h "$DB_HOST" -U "$DB_USERNAME" -d "$DB_DATABASE" -c '\q'; do
    echo "Database is unavailable - sleeping"
    sleep 1
done
echo "✅ Database connection established"

# Run migrations
echo "🔄 Running database migrations..."
php artisan migrate --force

# Run seeders only on first run
if [ ! -f "$FIRST_RUN_FLAG" ] && [ "${RUN_SEEDER:-false}" = "true" ]; then
    echo "🌱 First run detected - Running database seeders..."
    php artisan db:seed --force || true  # Continue even if seeder fails
    mkdir -p "$(dirname "$FIRST_RUN_FLAG")"
    touch "$FIRST_RUN_FLAG"
    chown -R www-data:www-data "$(dirname "$FIRST_RUN_FLAG")"
    echo "✅ First run setup completed"
else
    echo "ℹ️ Not running seeders (not first run or RUN_SEEDER=false)"
fi

# Cache configuration
echo "⚙️ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✨ Laravel initialization complete!"
