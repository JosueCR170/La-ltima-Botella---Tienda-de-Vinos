# ─────────────────────────────────────────────────────────────────
# Dockerfile — La Última Botella (Render + SQLite)
# Stack : Laravel 9 · PHP 8.0 · SQLite · Vite 4 · Node 18
# ─────────────────────────────────────────────────────────────────

# ── Etapa 1: Build de assets con Node/Vite ────────────────────────
FROM node:18-alpine AS node-builder

WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm install

COPY vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/
RUN npm run build


# ── Etapa 2: Imagen de producción con PHP + Laravel ───────────────
FROM php:8.0-fpm-alpine AS app

LABEL maintainer="La Última Botella" \
      version="2.0" \
      description="Tienda de Vinos — Laravel 9 + PHP 8.0 + SQLite (Render)"

# Instalar extensiones necesarias (SQLite en vez de MySQL)
RUN apk add --no-cache \
        libpng-dev \
        libzip-dev \
        oniguruma-dev \
        sqlite \
        sqlite-dev \
        curl \
        nginx \
        supervisor \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        mbstring \
        zip \
        gd \
        bcmath \
        opcache

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Instalar dependencias PHP
COPY composer.json composer.lock ./
RUN composer install \
        --no-dev \
        --no-interaction \
        --no-scripts \
        --optimize-autoloader \
        --prefer-dist

# Copiar código fuente
COPY . .

# Copiar assets compilados desde etapa Node
COPY --from=node-builder /app/public/build ./public/build

# Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copiar configuraciones de Nginx y Supervisor
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/php-opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Script de inicio: crea la BD, migra y seedea antes de arrancar
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=30s --retries=3 \
    CMD curl -fsSL http://localhost/up || exit 1

CMD ["/usr/local/bin/start.sh"]
