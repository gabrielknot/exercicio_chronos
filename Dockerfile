FROM alpine as env_builder
WORKDIR /html
COPY entryPoint.sh .
COPY .env .
RUN chmod +x entryPoint.sh
ENTRYPOINT ["/entryPoint.sh"]
FROM nginx 
COPY --from=env_builder /html /usr/share/nginx/html
CMD ["nginx", "-g", "daemon off;"]
#FROM php:7.3-fpm
#COPY . /usr/share/nginx/blog
#COPY --from=env_builder .env /usr/share/nginx/blog/.env
#RUN apt-get update && apt-get install -y \
#    git \
#    libzip-dev \
#    zip \
#    unzip
#
#RUN docker-php-ext-configure zip --with-libzip
#
#RUN docker-php-ext-install pdo_mysql zip
#
#RUN curl --silent --show-error https://getcomposer.org/installer | php && \
#    mv composer.phar /usr/local/bin/composer
#
#
