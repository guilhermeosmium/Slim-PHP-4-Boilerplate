FROM php:8.2-fpm

# Instalar dependências e extensões do PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    git \
    unzip

RUN docker-php-ext-install zip pdo_pgsql

RUN pecl install redis && docker-php-ext-enable redis

RUN pecl install mongodb && docker-php-ext-enable mongodb

RUN docker-php-ext-install sockets

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copiar o arquivo composer.json e composer.lock (se estiver presente)
COPY composer.json composer.lock ./

# Instalar as dependências do projeto
RUN composer install --no-scripts --no-autoloader --no-dev

# Em seguida, copie o restante do projeto para o diretório de trabalho
COPY . ./

# Execute o autoloader do Composer para gerar o autoloading otimizado
RUN composer dump-autoload --optimize