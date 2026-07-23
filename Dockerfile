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

# OPcache: WAJIB dinyalakan. Image serversideup mematikannya secara default
# (PHP_OPCACHE_ENABLE="0"), sehingga PHP mengompilasi ulang seluruh berkas Laravel +
# Filament pada SETIAP request — terukur ~3,8 detik boot per request di Railway.
# VALIDATE_TIMESTAMPS=0 karena isi container tidak pernah berubah setelah build,
# jadi pengecekan tanggal berkas hanya membuang I/O.
ENV PHP_OPCACHE_ENABLE=1
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=0

# Salin aplikasi + vendor hasil tahap 1.
COPY --chown=www-data:www-data --from=vendor /app /var/www/html

# serversideup menjalankan optimasi & migrasi otomatis via variabel AUTORUN_* (diatur di Railway).
# Aplikasi mendengarkan di port 8080.
