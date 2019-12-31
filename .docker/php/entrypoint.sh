#!/bin/bash
if [ ! -d "vendor" ]; then
    composer global require hirak/prestissimo -vvv
    composer install -vvv
fi
php-fpm