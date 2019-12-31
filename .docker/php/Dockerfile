FROM php:7.4-fpm

RUN apt-get update

RUN apt-get install -y \
        git \
        libzip-dev \
        unzip \
        && docker-php-ext-install zip

RUN curl https://getcomposer.org/composer.phar --output /usr/bin/composer
RUN chmod +x /usr/bin/composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get install tesseract-ocr -y

WORKDIR /var/www
COPY entrypoint.sh /tmp/entrypoint.sh

EXPOSE 9000

ENTRYPOINT [ "sh", "/tmp/entrypoint.sh" ]