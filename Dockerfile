FROM php:8.2-fpm

# Sistem bağımlılıkları
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx

# PHP extension'ları
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizini
WORKDIR /var/www

# Proje dosyalarını kopyala
COPY . .

# Bağımlılıkları yükle
RUN rm -rf vendor && composer install --optimize-autoloader --no-dev --no-scripts --ignore-platform-reqs

RUN rm -rf vendor && composer install --optimize-autoloader --no-dev --no-scripts --ignore-platform-reqs
RUN composer dump-autoload --optimize

# İzinler
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Nginx config
COPY docker/nginx.conf /etc/nginx/sites-enabled/default

EXPOSE 80

CMD service nginx start && php-fpm
