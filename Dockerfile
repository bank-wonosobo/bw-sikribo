# Use official PHP 7.4 CLI image
FROM php:7.4-cli

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Install Laravel dependencies
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 8000 (used by php artisan serve)
EXPOSE 8000

# Run Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
