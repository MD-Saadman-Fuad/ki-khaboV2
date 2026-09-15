FROM php:8.3-apache

# Enable Apache mod_rewrite for clean URLs
RUN a2enmod rewrite

# Install MySQL extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configure Apache to listen on environment variable PORT (defaults to 80)
ENV PORT=80
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf

# Copy project files
COPY . /var/www/html/

# Set working directory & permissions
WORKDIR /var/www/html/
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
