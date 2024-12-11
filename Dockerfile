FROM composer:2.8.3

RUN apk add --no-cache linux-headers autoconf build-base
RUN pecl install xdebug-3.4.0
RUN docker-php-ext-enable xdebug

RUN apk add bash vim
