FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    libxml2-dev \
    libzip-dev \
    libssl-dev \
    libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
COPY .env.example .env

RUN composer install --no-dev --optimize-autoloader
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

RUN chmod -R 775 public \
    && chmod -R 777 storage

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

COPY default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
