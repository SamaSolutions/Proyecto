#FROM php:8.2-apache-bullseye

# \f1 1\u-497?\f2\u8419?\f0  Actualiza repositorios y agrega utilidades base
#RUN apt-get update && apt-get install -y \
#    apt-utils \
#    curl \
#    git \
#    vim \
#    unzip \
#    zip \
#    libicu-dev \
#    libxml2-dev \
#    libzip-dev \
#    net-tools \ 
#    pkg-config \
#    build-essential \
# && docker-php-ext-install pdo pdo_mysql mysqli intl zip \
# && apt-get clean \
# && rm -rf /var/lib/apt/lists/*
     FROM debian:bookworm
     RUN apt update && apt install -y apache2 vim nano iputils-ping curl sudo git iproute2 zip unzip net-tools libicu-dev libxml2-dev libzip-dev pkg-config build-essential  
     RUN a2enmod rewrite 
     RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html|g' /etc/apache2/sites-available/000-default.conf \
     && echo '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>' >> /etc/apache2/sites-available/000-default.conf
     COPY . /var/www/html
     RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]
