FROM php:8.3-cli

# Устанавливаем системный установщик расширений
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# Устанавливаем PHP-расширения (pdo_mysql, amqp, zip)
RUN install-php-extensions pdo_mysql amqp zip

# Устанавливаем системные утилиты
RUN apt-get update && apt-get install -y unzip git && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-interaction --optimize-autoloader

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
