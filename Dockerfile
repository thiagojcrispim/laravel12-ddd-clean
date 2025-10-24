FROM php:8.3-fpm

# Instalar dependências e extensões necessárias para o Laravel + MySQL
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libonig-dev libxml2-dev curl \
 && docker-php-ext-install intl pdo_mysql zip bcmath \
 && rm -rf /var/lib/apt/lists/*

# Copiar o Composer (vem da imagem oficial)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
