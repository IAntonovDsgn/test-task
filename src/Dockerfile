FROM php:8.2-fpm

# Обновления установленных в системе (Linux) пакетов И установка новых пакетов без подтверждения
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libonig-dev \
    unzip \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Установка расширений PHP
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip

# Копирование двоичного файла Composer из исходного образа Composer в наш Docker-образ
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создание рабочей директории образа. Все последующие команды выполняются относительно этой папки.
WORKDIR /var/www

# Копируем код приложения в образ
COPY . .

# Установка зависимостей Composer в образ
RUN composer install --no-interaction --no-scripts --no-dev

# Установка прав
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

# Создаем временную директорию www-public-temp и копируем туда содержимое папки /var/www/public/ + даём права
RUN mkdir -p /var/www-public-temp \
    && cp -r /var/www/public/* /var/www-public-temp/ \
    && chown -R www-data:www-data /var/www-public-temp

VOLUME /var/www/public

# Копируем скрипт запуска приложения в образ, делаем его исполняемым
COPY start.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

# Запускаем скрипт во время запуска контейнера
CMD ["/usr/local/bin/start"]
