#!/bin/sh
set -e

APP_DIR=${APP_DIR:-"/var/www/html"}
cd "${APP_DIR}"

echo "Install vendor dependencies with PHP Composer"
composer install

COMPOSER_VENDOR_DIR=$(composer config vendor-dir)
if [ -n "$USER_ID" ] && [ -d "$COMPOSER_VENDOR_DIR" ]; then
  echo "WARNING: Changing owner ID of vendor folder to $USER_ID:$GROUP_ID"
  chown -R "$USER_ID:$GROUP_ID" "$COMPOSER_VENDOR_DIR"
fi

if [ -n "$USER_ID" ]; then
  echo "WARNING: Changing user on www.conf to $USER_ID"
  sed -i "s|user = .*|user = ${USER_ID}|" /usr/local/etc/php-fpm.d/www.conf
fi

if [ -n "$GROUP_ID" ]; then
  echo "WARNING: Changing group on www.conf to $GROUP_ID"
  sed -i "s|group = .*|group = ${GROUP_ID}|" /usr/local/etc/php-fpm.d/www.conf
fi

echo "Running Laravel migrations and seeder"
php artisan migrate --seed

cd - > /dev/null 2>&1
exec "$@"
