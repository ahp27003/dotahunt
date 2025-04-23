#!/bin/bash

# Exit on error
set -e

# Install PHP dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Install Node.js dependencies
npm install

# Build frontend assets
npm run production

# Clear application cache
php artisan cache:clear

echo "Build completed successfully!"
