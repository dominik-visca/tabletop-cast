FROM php:8.3-fpm as php_base

ENV DEBIAN_FRONTEND=noninteractive

WORKDIR /var/www

RUN apt-get update -y && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    liblz4-dev \
    libzstd-dev

RUN docker-php-ext-install mbstring bcmath gd intl pgsql pdo_pgsql zip \
        && rm -rf /var/lib/apt/lists/*

RUN pecl install msgpack && docker-php-ext-enable msgpack \
    && pecl install igbinary && docker-php-ext-enable igbinary \
    && yes | pecl install redis && docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Copy application code
COPY . /var/www

# Install PHP dependencies via composer as www-data
RUN composer install

# Install Node.js dependencies and run build
RUN npm install && npm run build

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www

# Configure PHP and entrypoint
COPY ./php.ini /usr/local/etc/php/conf.d/99-monitoring.ini

EXPOSE 9000
