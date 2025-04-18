FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 20.x (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Enable Apache modules
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
RUN pecl install redis && docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Composer files first and install PHP dependencies
COPY composer.* ./
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# --- Begin Front-End Setup ---

# Copy package files first to utilize Docker cache
COPY package*.json ./

# Install Node modules with clean cache
RUN npm cache clean --force && npm install

# Copy application files
COPY . .

# Build front-end assets with updated configuration
RUN npm run build

# --- End Front-End Setup ---

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache \
    && mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    && chmod -R 775 /var/www/html/storage/framework

# Environment setup
RUN cp .env.example .env

# Generate autoload files
RUN composer dump-autoload --optimize

# Configure PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Configure Apache
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Create startup script
RUN echo '#!/bin/bash\n\
cd /var/www/html\n\
chown -R www-data:www-data storage bootstrap/cache\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
apache2-foreground\n\
' > /start.sh && chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]