FROM php:8.1-fpm-bullseye

RUN apt-get update && apt-get install -y \
        git \
        zip libzip-dev

RUN pecl install xdebug && docker-php-ext-enable xdebug \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

COPY ./config/* /usr/local/etc/php/conf.d
COPY --from=composer:2.2.3 /usr/bin/composer /usr/bin/composer