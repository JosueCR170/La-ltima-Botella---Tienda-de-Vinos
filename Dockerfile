# ─────────────────────────────────────────────────────────────────
# Dockerfile — La Última Botella (Tienda de Vinos)
# Stack : Laravel 9 · PHP 8.0 · MySQL 8 · Vite 4 · Node 18
# ─────────────────────────────────────────────────────────────────

# ── Etapa 1: Build de assets con Node/Vite ────────────────────────
FROM node:18-alpine AS node-builder

WORKDIR /app

# Instalar dependencias NPM primero (aprovecha caché de Docker)
COPY package.json package-lock.json* ./
RUN npm install

# Copiar el resto del código y compilar los assets para producción
COPY vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/
RUN npm run build


# ── Etapa 2: Imagen de producción con PHP + Laravel ───────────────
FROM php:8.0-fpm-alpine AS app

LABEL maintainer="La Última Botella" \
      version="1.0" \
      description="Tienda de Vinos — Laravel 9 + PHP 8.0 + MySQL"

# Instalar extensiones de PHP requeridas por Laravel 9
RUN apk add --no-cache \
        libpng-dev \
        libzip-dev \
        oniguruma-dev \
        curl \
        nginx \
        supervisor \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        gd \
        bcmath \
        opcache

# Instalar Composer (gestor de dependencias de PHP)
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Instalar dependencias PHP (sin dev) usando el composer.lock para builds reproducibles
COPY composer.json composer.lock ./
RUN composer install \
        --no-dev \
        --no-interaction \
        --no-scripts \
        --optimize-autoloader \
        --prefer-dist

# Copiar el código fuente de la aplicación
COPY . .

# Copiar los assets compilados desde la etapa Node
COPY --from=node-builder /app/public/build ./public/build

# Permisos correctos para Laravel (storage y bootstrap/cache)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copiar configuración de Nginx y Supervisor
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php-opcache.ini /usr/local/etc/php/conf.d/opcache.ini

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=15s --retries=3 \
    CMD curl -fsSL http://localhost/up || exit 1

# Supervisor gestiona Nginx + PHP-FPM como procesos concurrentes
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
