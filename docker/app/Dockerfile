FROM php:8.3-fpm AS app

ENV APP_ENV=prod

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpq-dev \
    && docker-php-ext-install intl opcache pdo pdo_pgsql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip

WORKDIR /var/www/app

COPY . .

RUN php composer.phar install --no-scripts --no-dev

EXPOSE 9000

CMD ["php-fpm", "--nodaemonize"]