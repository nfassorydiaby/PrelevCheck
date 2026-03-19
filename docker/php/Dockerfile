FROM php:8.3-fpm-alpine

# Extensions système nécessaires
RUN apk add --no-cache \
    git \
    curl \
    libpq-dev \
    icu-dev \
    zip \
    unzip \
    oniguruma-dev \
    autoconf \
    g++ \
    make

# Extensions PHP
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    intl \
    mbstring \
    opcache

# Redis via PECL
RUN pecl install redis && docker-php-ext-enable redis

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Symfony CLI (optionnel mais pratique)
RUN apk add --no-cache bash && \
    curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]