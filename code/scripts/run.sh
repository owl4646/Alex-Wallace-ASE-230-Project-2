#!/usr/bin/env bash
# One-command Laravel run script (local development)
set -e
echo "Assuming composer and php installed."
if [ ! -f composer.json ]; then
  echo "composer.json not found in $(pwd)"
  exit 1
fi
composer install --no-interaction
cp .env.example .env || true
php artisan key:generate || true
php artisan migrate --force || true
php artisan serve --host=0.0.0.0 --port=8000