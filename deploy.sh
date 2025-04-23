#!/bin/bash

# Render.com deployment script for DotaHunt

# Install PHP dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Install Node.js dependencies
npm install

# Build frontend assets
npm run production

# Clear application cache
php artisan cache:clear

# Generate application key if not set
php artisan key:generate --force

# Run database migrations
php artisan migrate --force

# Optimize the application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the application
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
