FROM php:8.2-fpm-alpine

RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    libzip-dev \
    zip \
    unzip \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    autoconf \
    build-base \
    linux-headers

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip

RUN pecl channel-update pecl.php.net && \
    pecl install swoole && \
    docker-php-ext-enable swoole

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /var/www
WORKDIR /var/www

COPY . .

RUN if [ -f "composer.json" ]; then composer install --no-dev --optimize-autoloader; fi

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 8000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
