FROM php:8.2-cli

RUN apt-get update && apt-get install -y git unzip libzip-dev libsqlite3-dev libpq-dev && docker-php-ext-install zip pdo pdo_sqlite pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN APP_ENV=prod composer install --no-dev --optimize-autoloader --no-scripts
RUN php bin/console cache:clear --env=prod --no-warmup || true
RUN php bin/console cache:warmup --env=prod || true

EXPOSE 10000

CMD php bin/console doctrine:migrations:migrate --no-interaction --env=prod && php -S 0.0.0.0:10000 -t public/
