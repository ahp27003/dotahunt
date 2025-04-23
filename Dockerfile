# Dockerfile for Laravel (DotaHunt) on Render.com
FROM composer:2.2 as composerbin

FROM php:8.2-cli-alpine as vendor
RUN apk add --no-cache zip unzip git icu-dev oniguruma-dev postgresql-dev libzip-dev zlib-dev \
    && docker-php-ext-configure zip && docker-php-ext-install zip pdo_pgsql intl
COPY --from=composerbin /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction

# Build stage for Node assets
FROM node:18 as nodebuild
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install --no-audit --no-fund

# Copy source and build assets
COPY . .
RUN npm run build || npm run prod || echo "No build script found"

# Final PHP runtime
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache libpng libpng-dev libjpeg-turbo-dev libwebp-dev libxpm-dev freetype-dev libzip-dev zip unzip git bash icu-dev oniguruma-dev postgresql-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install gd pdo pdo_pgsql intl zip opcache

# Copy application source
WORKDIR /var/www
COPY --from=vendor /app .
COPY --from=nodebuild /app/public ./public
COPY --from=nodebuild /app/resources ./resources
COPY --from=nodebuild /app/bootstrap ./bootstrap
COPY --from=nodebuild /app/database ./database
COPY --from=nodebuild /app/routes ./routes
COPY --from=nodebuild /app/storage ./storage
COPY --from=nodebuild /app/app ./app
COPY --from=nodebuild /app/config ./config

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port
EXPOSE 8080

# Set environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false

# Start script
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
