FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libonig-dev libxml2-dev zip unzip curl \
    && docker-php-ext-install pdo_mysql mysqli

COPY php.ini /usr/local/etc/php/
RUN a2enmod rewrite

WORKDIR /var/www/html
