FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY ../../www ./

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-interaction \
    && composer require laravel/ui \
    && php artisan ui bootstrap --auth \
    && composer dump-autoload --optimize \
    && composer require diglactic/laravel-breadcrumbs \
    && php artisan optimize
EXPOSE 9000
