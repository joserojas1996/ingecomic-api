FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libexif-dev \
    zlib1g-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql exif zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY --chown=www-data:www-data . /var/www/html

# Ajustar permisos de directorios y archivos
RUN chmod -R 775 /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R ug+s /var/www/html

CMD php-fpm