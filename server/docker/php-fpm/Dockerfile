FROM php:7.1-fpm
MAINTAINER stepan.okhorzin@gmail.com

RUN apt-get update \
    && apt-get -y install \
            libicu-dev \
            libmcrypt-dev \
            zlib1g-dev \
            libpq-dev \
        --no-install-recommends \

    # Install PHP extensions
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install opcache \
    && docker-php-ext-install memcached \

    # Don't clear our valuable environment vars in PHP
    && echo "\nclear_env = no" >> /usr/local/etc/php-fpm.conf \

    # Fix write permissions with shared folders
    && usermod -u 1000 www-data