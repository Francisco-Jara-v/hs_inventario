FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install intl zip gd pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /app

# Copiar proyecto
COPY . .


    # Crear carpetas necesarias para Laravel
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Permisos
RUN chmod -R 775 storage bootstrap/cache

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader
# Permisos
RUN chmod -R 775 storage bootstrap/cache

# Exponer puerto
EXPOSE 8080

# Arrancar Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080

CMD php artisan migrate
