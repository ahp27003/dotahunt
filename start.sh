#!/bin/bash

# Exit on error
set -e

# Run database migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the application
php -S 0.0.0.0:$PORT -t public
