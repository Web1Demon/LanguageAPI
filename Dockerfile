FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 9000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]
