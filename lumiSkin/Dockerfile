FROM php:8.3.11-apache

RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN docker-php-ext-install pdo_mysql

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cambia el DocumentRoot de Apache a /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Reescribe todas las configuraciones de Apache que apuntan a /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Copia todo el proyecto Laravel
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala dependencias
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Genera key de la app
RUN php artisan key:generate

# Ejecuta migraciones (opcional)
RUN php artisan migrate

# Permisos
RUN chmod -R 777 storage bootstrap/cache

# Habilita mod_rewrite
RUN a2enmod rewrite

# Reinicia apache
RUN service apache2 restart
