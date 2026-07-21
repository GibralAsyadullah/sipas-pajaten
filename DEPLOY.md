# Panduan Deploy — SIPAS Pajaten

Aplikasi: **Laravel 13 + Filament 5** (server-rendered PHP).
Arsitektur produksi: **Database di Supabase (Postgres)** + **Aplikasi di Railway** (atau Render).

> Vercel **tidak dipakai** karena serverless-nya tidak cocok untuk Laravel dengan upload file.

---

## 1. Database — Supabase (SUDAH SELESAI ✅)

- Project: **sipas-pajaten** (region Singapore, Postgres 17).
- Skema 21 tabel + seluruh data (141 sampah, 21 anggota, 24 quiz, 45 foto IG, 19 jadwal, dll.) sudah dimuat.
- Connection string (Session pooler, port 5432) dipakai sebagai `DB_URL` di Railway (lihat bawah).

Kalau perlu muat ulang data dari nol: jalankan `database/pg/pg-schema.sql` lalu `database/pg/pg-data.sql`
di **Supabase → SQL Editor**. (File data ini **tidak** memuat akun admin demi keamanan — buat admin baru
lewat `php artisan make:filament-user` lalu nyalakan kolom `is_admin` = true pada barisnya.)

---

## 2. Aplikasi — Railway

### a. Buat service
1. Buka [railway.app](https://railway.app) → **New Project** → **Deploy from GitHub repo**.
2. Pilih repo **GibralAsyadullah/sipas-pajaten**, branch **`main`**.
3. Railway mendeteksi `Dockerfile` di root dan membangun image otomatis. Port container: **8080**.

> **Branch yang di-deploy adalah `main`, bukan `develop`.** Push ke `develop` saja
> **tidak** memicu deploy — pernah bikin bingung karena situs tampak "tidak berubah"
> padahal commit sudah masuk. Alur kerjanya: kerjakan di `develop`, lalu
> `git push origin develop:main` untuk merilis.

### b. Variabel Environment (Railway → service → Variables)
Salin semua ini. Ganti `PASSWORD_ANDA` dan `APP_URL` sesuai milik Anda:

```
APP_NAME=SIPAS Pajaten
APP_ENV=production
APP_KEY=base64:yJzfGb2DyEfZxIBJXYBjckwjl8VzLrqunc7P+K35/d8=
APP_DEBUG=false
APP_URL=https://NAMA-APP-ANDA.up.railway.app

DB_CONNECTION=pgsql
DB_URL=postgresql://postgres.yaqmzozlspjwuxmbillz:PASSWORD_ANDA@aws-0-ap-southeast-1.pooler.supabase.com:5432/postgres
DB_SSLMODE=require

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public
LOG_CHANNEL=stderr

# Otomatis: buat symlink storage + cache config/route/view saat boot.
# (Migrasi akan berjalan tapi jadi no-op karena skema sudah ada di Supabase.)
AUTORUN_ENABLED=true
SSL_MODE=off
```

> `APP_KEY` di atas sudah digenerate khusus untuk produksi — jangan pakai kunci dev lokal.
> `SSL_MODE=off` karena Railway sudah menangani HTTPS di edge; container cukup melayani HTTP di 8080.

### c. Deploy
Simpan variabel → Railway otomatis build & deploy. Setelah selesai, buka domain yang diberikan Railway.
Halaman utama & `/admin` (login pakai akun admin yang sudah ada) harus tampil dengan data lengkap.

---

## 3. Catatan penting soal FOTO / upload

- **Foto yang sudah ada** (45 feed IG, 20 avatar anggota, 12 foto jadwal, 3 poster) **ikut ter-deploy**
  karena sudah dimasukkan ke repo (`storage/app/public/`).
- **Upload BARU lewat panel admin** bersifat **sementara** di Railway — hilang saat re-deploy,
  karena filesystem container tidak permanen. Tiga pilihan:
  1. **Commit foto baru ke git** (paling sederhana untuk proyek KKN).
  2. **Pasang Railway Volume** di `/var/www/html/storage/app/public` lalu upload ulang foto.
  3. **Pindah ke Supabase Storage** (S3-compatible) — paling "benar" untuk jangka panjang,
     tapi perlu setel `FILESYSTEM_DISK=s3` + kredензial Storage. Bisa dikerjakan menyusul.

---

## 4. Catatan performa (penting)

- **OPcache wajib nyala.** Image `serversideup/php` mematikannya secara bawaan
  (`PHP_OPCACHE_ENABLE="0"`), sehingga PHP mengompilasi ulang ribuan berkas Laravel +
  Filament pada setiap request. Terukur menambah **~3,8 detik per request** di Railway.
  Sudah dipasang permanen lewat `ENV` di `Dockerfile`, jadi tidak perlu diatur di Railway.
- **Katalog sampah & bank soal di-cache.** Dulu setiap request (termasuk panel admin dan
  `/up`) menarik ulang seluruh tabel `waste_items` + `quiz_questions` dari Supabase.
  Sekarang lewat `Cache` dengan pembersihan otomatis saat pengurus menyunting data.
### Langkah berikutnya yang belum dikerjakan

Setelah OPcache nyala, `/up` (tanpa sesi, tanpa DB) turun dari **4,3 dtk → 0,4 dtk**.
Tapi halaman biasa masih ~4 dtk. Hasil pengukuran TTFB di produksi:

| Halaman | TTFB | Kueri di controller |
|---|---|---|
| `/up` | ~0,4 dtk | — |
| `/lokasi`, `/klasifikasi` | ~4,0 dtk | **nol** |
| `/galeri`, `/jadwal` | ~5,2 dtk | banyak |

Halaman tanpa kueri sama sekali tetap 4 detik, dan menambah banyak kueri hanya
menambah ~1 detik. Artinya yang mahal adalah **membuka koneksi** ke Postgres
(PHP-FPM bikin koneksi baru tiap request, lewat session pooler + TLS ≈ 3,5 dtk),
bukan kuerinya.

Yang menyeret halaman polos ke Postgres adalah `SESSION_DRIVER=database` dan
`CACHE_STORE=database`. Ganti keduanya di Railway → `file`:

```
SESSION_DRIVER=file
CACHE_STORE=file
```

Perkiraan: `/`, `/lokasi`, `/klasifikasi` tidak lagi menyentuh Postgres sama sekali
→ ~4 dtk menjadi ~0,5 dtk. Halaman yang memang perlu data (galeri, jadwal, tentang,
game) tetap menanggung biaya koneksi.

Konsekuensi yang perlu diterima:
- Sesi tersimpan di container, jadi **admin ter-logout setiap kali re-deploy**.
  Untuk situs informasi desa ini praktis tidak terasa.
- Hanya aman selama service Railway **satu replika**. Kalau nanti ditambah replika,
  kembalikan ke `database` agar sesi & cache seragam antar container.

Kalau halaman ber-database juga mau dipercepat, langkah setelahnya adalah koneksi
PDO persisten (`PDO::ATTR_PERSISTENT` di `config/database.php`) supaya worker
PHP-FPM memakai ulang koneksi. Perlu diuji dulu — pooler dan koneksi persisten
kadang bermasalah pada prepared statement.

---

## 5. Troubleshooting
- **Aset panel admin (Filament) tidak muncul** → jalankan sekali di Railway shell:
  `php artisan filament:assets`.
- **Error koneksi DB** → pastikan pakai **Session pooler (port 5432)**, bukan transaction pooler (6543),
  dan `DB_SSLMODE=require`.
- **Halaman blank / 500** → sementara set `APP_DEBUG=true` untuk melihat pesan, lalu kembalikan `false`.

---

## Alternatif: Render
Sama seperti Railway — **New → Web Service → dari repo**, environment **Docker**, port **8080**,
dan set variabel environment yang sama seperti di atas.
