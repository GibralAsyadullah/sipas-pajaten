# Cara Pasang: SIPAS Pajaten — Starter Kit Laravel (Fase 1–2)

Paket ini berisi hasil konversi `WebsiteDesaPajatenEdukasi.html` menjadi struktur Laravel:
CSS terpisah, 8 halaman Blade, layout + partial, JavaScript dipecah per halaman, route, dan controller.
Ini menyelesaikan **Fase 1–2** dari `LANGKAH-MIGRASI.md` (fondasi + konten statis).
Semua fitur klien (game, quiz, kalkulator, sertifikat, poster, mode gelap, pencarian, splash) tetap berfungsi.

## Langkah pemasangan (±10 menit)

1. Buat project Laravel (di terminal Laragon):

```bash
cd D:\laragon\www
composer create-project laravel/laravel sipas-pajaten
```

2. **Salin isi folder ini** ke folder project dengan struktur yang sama (timpa file yang ada):

```
laravel-files/app/Http/Controllers/PageController.php  →  sipas-pajaten/app/Http/Controllers/
laravel-files/public/css/  dan  public/js/             →  sipas-pajaten/public/
laravel-files/resources/views/                         →  sipas-pajaten/resources/views/
laravel-files/routes/web.php                           →  sipas-pajaten/routes/web.php  (timpa)
```

3. Restart Laragon (Stop → Start All) lalu buka **http://sipas-pajaten.test** — website langsung jalan.
   (Tidak perlu `npm run dev` — pada fase ini aset dimuat langsung dari `public/`, belum lewat Vite.)

## Apa yang berubah dari versi HTML asli

- Navigasi tab SPA → **8 halaman terpisah** (`/`, `/lokasi`, `/game`, `/paparan`, `/klasifikasi`, `/galeri`, `/jadwal`, `/tentang`). Fungsi `gotoTab()`/`activateTab()` diganti shim yang berpindah URL, jadi semua tombol lama tetap bekerja.
- **Splash screen hanya muncul sekali per sesi** (pakai `sessionStorage`), tidak setiap pindah halaman.
- **Hasil pencarian jenis sampah** kini membuka `/klasifikasi?item=N` lalu otomatis memunculkan modal detailnya.
- JavaScript dipecah: `data.js` (data & gambar bersama) + `app.js` (dimuat semua halaman: tema, suara, pencarian, pengaturan) + satu file per halaman.

## Yang BELUM berubah (sengaja, untuk Fase 3–4)

- Lapor sampah, anggota tim, UMKM, galeri, dan catatan masih tersimpan di `localStorage` browser — akan diganti database + form POST sesuai Langkah 8–10 di `LANGKAH-MIGRASI.md`.
- Mode Admin masih memakai PIN di JavaScript — akan diganti login Laravel Breeze pada Langkah 11.
- Aset masih dimuat sebagai file statis biasa; migrasi ke Vite bersifat opsional setelah semuanya stabil.

## Checklist uji cepat setelah pasang

1. Semua 8 menu bisa diklik dan tampil identik dengan file HTML lama.
2. Mode gelap & ukuran teks tersimpan saat berpindah halaman.
3. Game pilah dan quiz jalan (suara, konfeti, skor terbaik).
4. Kalkulator tabungan menghitung; sertifikat & poster bisa diunduh.
5. Pencarian (ikon 🔍 atau tombol `/`) — klik hasil "Jenis Sampah" harus lompat ke halaman Pilah dan membuka modalnya.
6. Timeline jadwal + ring persentase muncul di halaman Jadwal.
