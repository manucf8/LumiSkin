FROM php:8.3-fpm

# Instala dependencias necesarias
RUN apt-get update -y && apt-get install -y openssl zip unzip git

# Extensión de PHP para MySQL
RUN docker-php-ext-install pdo_mysql

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

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
    
# Ejecuta migraciones
RUN php artisan migrate
    
# Permisos necesarios
RUN chmod -R 777 storage bootstrap/cache
    
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]