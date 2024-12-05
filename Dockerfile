# Use uma imagem base do PHP com Apache
FROM php:8.2-apache

# Instale dependências do sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql zip \
    && apt-get clean

# Ative o mod_rewrite do Apache
RUN a2enmod rewrite

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Copie somente os arquivos necessários para instalar dependências
COPY composer.json composer.lock ./

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instale as dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Copie o restante do código do aplicativo
COPY . .

# Ajuste as permissões
RUN chown -R www-data:www-data /var/www/html

# Exponha a porta 80
EXPOSE 80

# Comando para iniciar o Apache
CMD ["apache2-foreground"]
