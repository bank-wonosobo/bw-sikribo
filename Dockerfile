# Use PHP 7.4 CLI image
FROM php:7.4-cli

# Set working directory
WORKDIR /app

# Install dependencies including ZIP and GD extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set memory limit for Composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Copy application files
COPY . /app

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Install Laravel dependencies
RUN composer install

# Switch back to root user
USER root

# Expose port 8000
EXPOSE 8000

# Run Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
