FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
WORKDIR /var/www
COPY ../ .
RUN chmod +x ./app-build.sh
CMD ["./app-build.sh"]
