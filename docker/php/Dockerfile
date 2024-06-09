FROM php:8.3.8-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:2.7.6 /usr/bin/composer /usr/local/bin/composer

RUN apt-get update -y && \
    apt-get install wget libpq-dev libzip-dev libpng-dev libjpeg-dev git curl nodejs zip -y && \
    docker-php-ext-install pdo zip pdo_pgsql && docker-php-ext-configure gd --with-jpeg && docker-php-ext-install -j$(nproc) gd

RUN apt-get install -y libicu-dev \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl

RUN pecl install redis && docker-php-ext-enable redis

WORKDIR /var/www
