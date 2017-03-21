FROM php:7.1-fpm-alpine
MAINTAINER stepan.okhorzin@gmail.com

ARG APCU_VERSION=5.1.8
ARG APCU_BC_VERSION=1.0.3

ENV MEMCACHED_DEPS zlib-dev libmemcached-dev cyrus-sasl-dev git

RUN apk update && apk upgrade

RUN apk add --no-cache --virtual .persistent-deps \
    libmcrypt-dev \
    postgresql-dev \
    libxml2-dev

RUN pecl install xdebug \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install soap

RUN set -xe \
    && apk add --no-cache \
        --virtual .memcached-deps \
        $MEMCACHED_DEPS \
    && git clone --branch php7 https://github.com/php-memcached-dev/php-memcached /usr/src/php/ext/memcached/ \
            && docker-php-ext-configure memcached \
            && docker-php-ext-install memcached \
            && rm -rf /usr/src/php/ext/memcached \
            && apk del --no-cache libmemcached-dev \
            			zlib-dev \
            			cyrus-sasl-dev

RUN docker-php-ext-enable xdebug \
    && echo "\nclear_env = no" >> /usr/local/etc/php-fpm.conf \

    && echo "xdebug.remote_enable=on\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9000\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=dbgp\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0\n" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \

    # Fix write permissions with shared folders
    && usermod -u 1000 www-data  \

    && rm -rf /tmp/*