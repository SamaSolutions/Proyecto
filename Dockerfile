FROM php:8.2-apache-bullseye

# \f1 1\u-497?\f2\u8419?\f0  Actualiza repositorios y agrega utilidades base
RUN apt-get update && apt-get install -y \
    apt-utils \
    curl \
    git \
    vim \
    unzip \
    zip \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    pkg-config \
    build-essential \
 && docker-php-ext-install pdo pdo_mysql mysqli intl zip \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

