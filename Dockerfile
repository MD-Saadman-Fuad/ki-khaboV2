FROM php:8.3-apache

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Install MySQL extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files
COPY . /var/www/html/

# Set working directory & permissions
WORKDIR /var/www/html/
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
