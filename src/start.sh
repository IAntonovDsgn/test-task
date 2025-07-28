#!/bin/bash

# На всякий случай чистим конфиг и кэш
php artisan config:clear
php artisan config:cache

# Создаем файл .env
cp .env.example .env

# Установка прав (на случай если том перезаписал права)
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache

# Копируем данные из временной директории /var/www-public-temp/ в общий монтированный том /var/www/public/
cp -r /var/www-public-temp/. /var/www/public/

# Создание симлинка storage и выдача на него прав
php artisan storage:link
chown -R www-data:www-data /var/www/public/storage
chmod -R 775 /var/www/public/storage

# Проверяем готовность бд
while ! mysqladmin ping -h mariadb -u root -ppassword; do
    sleep 1
done

# Запуск миграций и сидеров бд
php artisan migrate --force
php artisan db:seed --class=UserSeeder --force --no-interaction
php artisan db:seed --class=ReviewSeeder --force --no-interaction

# Выдаем права на запись в логи, которые появятся после миграций
chown -R www-data:www-data /var/www/storage/logs/laravel.log

# Чистим кэш конфига, генерируем ключ шифрования
php artisan config:cache
php artisan config:clear
php artisan key:generate

# Удержание запущенного процесса PHP-FPM
exec php-fpm
