# SIPAS Pajaten — image produksi untuk Railway / Render (Laravel 13 + Filament 5)
# Basis: serversideup/php (nginx + php-fpm siap-Laravel, jalan sebagai non-root, port 8080).

# --- Tahap 1: pasang dependency PHP via Composer ---
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --optimize --no-dev

# --- Tahap 2: runtime ---
FROM serversideup/php:8.3-fpm-nginx

# Ekstensi tambahan:
#  - gd       : kompres/konversi foto ke WebP
#  - pdo_pgsql: koneksi Supabase Postgres
#  - intl     : format angka Filament (Number::format) — wajib untuk panel admin
#  - bcmath, zip: lazim dibutuhkan Filament (perhitungan presisi, ekspor)
USER root
RUN install-php-extensions gd pdo_pgsql intl bcmath zip
USER www-data

# Salin aplikasi + vendor hasil tahap 1.
COPY --chown=www-data:www-data --from=vendor /app /var/www/html

# serversideup menjalankan optimasi & migrasi otomatis via variabel AUTORUN_* (diatur di Railway).
# Aplikasi mendengarkan di port 8080.
