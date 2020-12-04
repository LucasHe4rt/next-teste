FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client

RUN apt-get clean && rm -rf /var/lib/apt/lists/* && \
docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u 1000 -d /home/next next
RUN mkdir -p /home/next/.composer && \
    chown -R next:next /home/next

WORKDIR /var/www

USER next
