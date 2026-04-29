#!/bin/sh
# ─────────────────────────────────────────────────────────────────
# start.sh — Script de inicio para Render + SQLite
# Se ejecuta cada vez que el contenedor arranca
# ─────────────────────────────────────────────────────────────────

set -e

DB_PATH="${DB_DATABASE:-/var/data/database.sqlite}"
DB_DIR=$(dirname "$DB_PATH")

echo ">>> Verificando directorio de base de datos: $DB_DIR"
mkdir -p "$DB_DIR"

echo ">>> Creando archivo SQLite si no existe..."
touch "$DB_PATH"
chown www-data:www-data "$DB_PATH"
chmod 664 "$DB_PATH"

echo ">>> Corriendo migraciones..."
php artisan migrate:fresh --force

echo ">>> Corriendo seeders..."
php artisan db:seed --force

echo ">>> Cacheando configuración..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ">>> Iniciando Supervisor (Nginx + PHP-FPM)..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
