# Base PHP image with Composer installation
FROM serversideup/php:8.2-fpm-nginx AS base
WORKDIR /var/www/html

USER root
RUN install-php-extensions intl
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-plugins --no-scripts --prefer-dist

# Node image for building assets
FROM node:20 AS static-assets
WORKDIR /app
COPY . .
COPY --from=base --chown=www-data:www-data /var/www/html .
RUN npm install
RUN npm run build

# Final image
FROM serversideup/php:8.2-fpm-nginx

WORKDIR /var/www/html

USER root

RUN apt-get update -y && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    liblz4-dev \
    libzstd-dev \
    postgresql-client

RUN install-php-extensions intl

# Copy nginx configuration
COPY docker/prod/nginx.conf /etc/nginx/conf.d/custom.conf

# Copy node_modules first for Filament assets
COPY --from=static-assets --chown=www-data:www-data /app/node_modules ./node_modules

# Copy application files
COPY --from=base --chown=www-data:www-data /var/www/html .
COPY --chown=www-data:www-data . .

# Now run Filament upgrade and publish assets
RUN composer dump-autoload

# Copy built assets
COPY --from=static-assets --chown=www-data:www-data /app/public/build ./public/build

# Cache and optimize
RUN php artisan storage:link && \
    php artisan view:cache && \
    php artisan route:cache && \
    php artisan config:cache

# Copy and setup entrypoint
COPY --chmod=755 docker/prod/99-entrypoint.sh /etc/entrypoint.d/99-entrypoint.sh

USER www-data


