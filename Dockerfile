FROM php:8-fpm-alpine AS fpm

LABEL maintainer="Estudo-Laravel"

RUN apk add --no-cache \
        acl \
        autoconf \
        g++ \
        jpeg-dev \
        libpng-dev \
        libwebp-dev \
        libzip-dev \
        make \
        npm \
        postgresql-dev \
        tzdata \
    && docker-php-ext-configure \
        gd --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        gd \
        pcntl \
        pdo_mysql \
        pdo_pgsql \
        zip \
        sockets \
    && pecl install -D 'enable-redis-igbinary="no" enable-redis-lzf="no" enable-redis-zstd="no"' redis \
    && docker-php-ext-enable redis \
    && php -r "readfile('http://getcomposer.org/installer');" \
        | php -- --install-dir=/usr/bin/ --filename=composer \
