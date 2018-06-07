FROM php:7.1-fpm

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install json \
    && apt-get update \
    && apt-get install -y \
        git \
        zlib1g-dev \
        bzip2 \
        xz-utils \
        libssl-dev \
        libicu-dev \
        ssh \
        libcurl4-openssl-dev \
        unzip \
 && rm -rf /var/lib/apt/lists/*

RUN echo "date.timezone = UTC" > /usr/local/etc/php/php.ini