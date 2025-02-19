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
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files first
COPY composer.* ./

# Install dependencies
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Copy application
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# Environment setup
RUN cp .env.example .env

# Generate autoload files
RUN composer dump-autoload --optimize

# Install dev dependencies needed for artisan commands
RUN composer install --prefer-dist --no-interaction

# Now run artisan commands
RUN php artisan key:generate --force
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan view:clear

# Configure PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Create PHP configuration directory and file
RUN mkdir -p /usr/local/etc/php/conf.d
RUN echo "\
memory_limit = 512M\n\
max_execution_time = 300\n\
upload_max_filesize = 50M\n\
post_max_size = 50M\n\
error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT\n\
display_errors = Off\n\
display_startup_errors = Off\n\
log_errors = On\n\
error_log = /var/log/php/error.log\n\
\n\
[opcache]\n\
opcache.enable = 1\n\
opcache.memory_consumption = 256\n\
opcache.max_accelerated_files = 20000\n\
opcache.validate_timestamps = 0\
" > /usr/local/etc/php/conf.d/custom.ini

# Configure PHP-FPM
RUN mkdir -p /var/run && \
    touch /var/run/php-fpm.sock && \
    chown -R www-data:www-data /var/run/php-fpm.sock

# Update PHP-FPM configuration
RUN echo "\
[www]\n\
user = www-data\n\
group = www-data\n\
listen = /var/run/php-fpm.sock\n\
listen.owner = www-data\n\
listen.group = www-data\n\
listen.mode = 0660\n\
pm = dynamic\n\
pm.max_children = 10\n\
pm.start_servers = 2\n\
pm.min_spare_servers = 1\n\
pm.max_spare_servers = 3\n\
request_terminate_timeout = 300\n\
" > /usr/local/etc/php-fpm.d/www.conf

# Configure Nginx
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
RUN mkdir -p /var/log/nginx

# Create PHP log directory
RUN mkdir -p /var/log/php

# Create startup script
RUN echo '#!/bin/bash\n\
mkdir -p /var/run\n\
touch /var/run/php-fpm.sock\n\
chown -R www-data:www-data /var/run/php-fpm.sock\n\
nginx\n\
php-fpm\n\
' > /start.sh && chmod +x /start.sh

# Expose port 80 for Nginx
EXPOSE 80

# Expose port 9000
EXPOSE 9000

# Start Nginx and PHP-FPM
CMD ["/start.sh"]