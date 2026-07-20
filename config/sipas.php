<?php

return [

    /*
    | Nomor WhatsApp tujuan tombol chat melayang.
    | Format internasional tanpa "+" dan tanpa spasi, contoh: 6281234567890.
    | Kosongkan untuk menyembunyikan tombol chat.
    */
    'wa_number' => env('SIPAS_WA_NUMBER', ''),

    /*
    | Nama yang ditampilkan pada tombol chat.
    */
    'wa_label' => env('SIPAS_WA_LABEL', 'Tim KKN Pajaten'),

    /*
    | Pesan yang otomatis terisi saat warga membuka chat.
    */
    'wa_text' => env('SIPAS_WA_TEXT', 'Halo, saya ingin bertanya soal Bank Sampah Desa Pajaten.'),

    /*
    | Alamat publik situs, dipakai untuk membuat QR code.
    | Kosongkan untuk memakai alamat yang sedang dibuka.
    */
    'site_url' => env('SIPAS_SITE_URL', ''),

    /*
    | Pembagian pekan KKN sesuai rundown resmi (8 Juli - 8 Agustus 2026).
    | Kunci array = kolom 'minggu' pada tabel schedules.
    */
    'pekan' => [
        1 => ['label' => 'Minggu 1', 'rentang' => '8 – 14 Juli 2026'],
        2 => ['label' => 'Minggu 2', 'rentang' => '15 – 21 Juli 2026'],
        3 => ['label' => 'Minggu 3', 'rentang' => '22 – 28 Juli 2026'],
        4 => ['label' => 'Minggu 4', 'rentang' => '29 Juli – 4 Agustus 2026'],
        5 => ['label' => 'Penutupan', 'rentang' => '5 – 8 Agustus 2026'],
    ],

];
