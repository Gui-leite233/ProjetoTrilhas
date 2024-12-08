# Use uma imagem base do PHP 8.2
FROM php:8.2-fpm

# Defina o diretório de trabalho
WORKDIR /var/www

# Instale dependências do sistema e o Composer
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Adicione o grupo 'sail' com um ID de grupo específico
RUN groupadd --force -g 1001 sail

# Adicione um usuário 'sail' e adicione-o ao grupo 'sail'
RUN useradd -m -g sail sail

# Copie os arquivos do Composer
COPY composer.lock ./
COPY composer.json ./

# Copie todos os arquivos do diretório atual
COPY . .

# Instale as dependências do Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Exponha a porta 9000
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]