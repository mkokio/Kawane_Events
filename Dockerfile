# Use the official PHP image with PHP 8.2.12 FPM
FROM php:8.2.12-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    && rm -rf /var/lib/apt/lists/*

# Copy your Laravel files to the container
COPY nginx/nginx.conf /etc/nginx/sites-available/default

# Set permissions for Laravel if required
# For example:
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy your Nginx configuration file
COPY nginx.conf /etc/nginx/sites-available/default

# Expose ports
EXPOSE 80

# Start PHP-FPM and Nginx
CMD service php8.2-fpm start && nginx -g "daemon off;"