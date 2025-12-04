FROM php:8.1-fpm
RUN apt-get update && apt-get install -y git zip unzip libpq-dev
RUN docker-php-ext-install pdo pdo_mysql
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . /var/www/html
RUN composer install --no-interaction --prefer-dist
RUN php artisan key:generate || true
CMD ["php-fpm"]