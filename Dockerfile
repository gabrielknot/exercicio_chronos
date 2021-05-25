FROM php:7.3-fpm
COPY . /usr/share/nginx/blog
RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor

COPY supervisord.conf /etc/supervisord.conf 
RUN docker-php-ext-configure zip --with-libzip

RUN docker-php-ext-install pdo_mysql zip

RUN curl --silent --show-error https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer
CMD ["/usr/bin/supervisord","-c","/etc/supervisord.conf"]
