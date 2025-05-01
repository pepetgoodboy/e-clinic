# Gunakan image resmi PHP 8.2 dengan Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy seluruh project Laravel ke container
COPY . .

# Copy konfigurasi Apache agar mengarah ke public/
RUN echo "<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Aktifkan mod_rewrite Laravel
RUN a2enmod rewrite

# Install dependensi Laravel
RUN composer install --optimize-autoloader --no-dev

# Set permission storage dan bootstrap
RUN chmod -R 775 storage bootstrap/cache && chown -R www-data:www-data .

# Expose port Apache
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
