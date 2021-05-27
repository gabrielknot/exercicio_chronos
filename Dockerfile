FROM composer as build
WORKDIR /usr/share/nginx/blog
COPY . /usr/share/nginx/blog
RUN composer install

FROM php:7.3-fpm
WORKDIR /usr/share/nginx/blog
COPY --from=build /usr/share/nginx/blog /usr/share/nginx/blog
RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip \
    unzip 

COPY www.conf /etc/php-fpm.d/www.conf
RUN docker-php-ext-configure zip --with-libzip

RUN docker-php-ext-install pdo_mysql zip

RUN curl --silent --show-error https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
EXPOSE 9000
#CMD ["supervisord","-n","-c","/etc/supervisord.conf"]
#CMD ["nginx"]
#CMD ["php-fpm","-F","--fpm-config=/etc/php-fpm.d/www.conf"]
