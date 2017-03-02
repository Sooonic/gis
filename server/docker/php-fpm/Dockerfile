FROM php:7.1-fpm
MAINTAINER stepan.okhorzin@gmail.com

ARG APCU_VERSION=5.1.8
ARG APCU_BC_VERSION=1.0.3

RUN apt-get update \
    && apt-get -y install \
            libicu-dev \
            libmcrypt-dev \
            zlib1g-dev \
            libpq-dev \
            gd-dev \
		    pcre-dev \
        --no-install-recommends \

    # Install PHP extensions
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install opcache \
    && docker-php-ext-install memcache \
    && docker-php-ext-install memcached \
    && docker-php-ext-install gd \
	&& pecl install apcu-$APCU_VERSION \
	&& docker-php-ext-enable apcu \
	&& pecl install apcu_bc-$APCU_BC_VERSION \
	&& docker-php-ext-enable apc \

    # Don't clear our valuable environment vars in PHP
    && echo "\nclear_env = no" >> /usr/local/etc/php-fpm.conf \

    # Fix write permissions with shared folders
    && usermod -u 1000 www-data