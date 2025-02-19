FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    nginx \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user
RUN useradd -G www-data,root -u 1000 -d /home/laravel laravel
RUN mkdir -p /home/laravel/.composer && \
    chown -R laravel:laravel /home/laravel

# Copy project files
COPY . /var/www/
COPY .env.example /var/www/.env

# Set permissions
RUN chown -R laravel:laravel /var/www
RUN chmod -R 755 /var/www/storage

# Install dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Generate application key
RUN php artisan key:generate

# Configure PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Expose port 9000
EXPOSE 9000

# Configure healthcheck
HEALTHCHECK --interval=30s --timeout=3s \
    CMD php artisan health:check || exit 1

# Start PHP-FPM
CMD ["php-fpm"]