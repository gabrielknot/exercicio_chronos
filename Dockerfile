FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    supervisor \
    nginx


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
COPY supervisord.conf /etc/supervisor/conf.d/php_nginx.conf
COPY site_nginx.conf /etc/nginx/sites-enabled/default
COPY site_php.conf /usr/local/etc/php-fpm.d/www.conf

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
#USER www-data
COPY --from=composer /usr/bin/composer /usr/local/bin/composer
COPY . /app
WORKDIR /app
RUN composer install

#WORKDIR /app
#RUN printf "<?php\nphpinfo();\n?>" > /app/public/index.php
RUN chmod -R 777 /app
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
