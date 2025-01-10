FROM php:8.1-apache

# Instalar dependencias del sistema
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
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd xml

# Instalar y habilitar MongoDB
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuración del directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto al contenedor
COPY . .

# Instalar las dependencias de Composer y optimizar
RUN composer update \
    && composer install --optimize-autoloader --no-dev

# Comandos de Laravel
RUN php artisan key:generate \
    && php artisan migrate --force \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Configuración de permisos
RUN chmod -R 775 public \
    && chmod -R 777 storage

# Copiar configuración personalizada de Apache
COPY default.conf /etc/apache2/sites-available/000-default.conf

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Exponer el puerto 80
EXPOSE 80
