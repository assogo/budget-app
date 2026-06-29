FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libsqlite3-dev \
    && docker-php-ext-install zip pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php bin/console doctrine:migrations:migrate --no-interaction || true

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000", "-t", "public/"]
