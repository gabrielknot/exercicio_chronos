#!/bin/bash
/usr/bin/supervisord -n -c /var/www/supervisord.conf
composer install
php artisan config:cache
php artisan key:generate
php artisan migrate

