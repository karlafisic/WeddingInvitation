# 1️⃣ Base image: PHP + Apache
FROM php:8.2-apache

# 2️⃣ Instalacija alata i ekstenzija
RUN apt-get update && apt-get install -y \
    libzip-dev libpq-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3️⃣ Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4️⃣ Kopiranje koda
COPY . /var/www/html
WORKDIR /var/www/html

# 5️⃣ Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 6️⃣ Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# 7️⃣ Apache mod_rewrite (za Laravel routing)
RUN a2enmod rewrite

# 8️⃣ Apache konfiguracija za Render port 10000
RUN echo '<VirtualHost *:10000>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf

EXPOSE 10000

# 9️⃣ Env vars i migrations na startup (opcionalno)
# Render može čitati .env vars iz dashboarda
# Ako želiš automatski migrate na deploy:
CMD ["sh", "-c", "php artisan migrate --force && apache2-foreground"]