<?php

namespace App\Providers;

use App\Models\QuizQuestion;
use App\Models\WasteItem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Nginx menyajikan aset dengan `Cache-Control: max-age=31536000, immutable`,
        // artinya browser tidak akan pernah mengecek ulang selama setahun. Tanpa versi
        // di URL-nya, perubahan CSS/JS tidak akan terlihat pengunjung lama sama sekali —
        // refresh biasa pun tidak menolong karena `immutable`. Waktu ubah berkas dipakai
        // sebagai versi supaya URL ikut berganti tiap kali berkasnya berubah.
        Blade::directive('aset', fn ($berkas) => "<?php echo asset({$berkas}).'?v='.(@filemtime(public_path({$berkas})) ?: 0); ?>");

        // Katalog sampah dipakai kotak pencarian di semua halaman, jadi dititipkan ke
        // layout — bukan View::share, supaya panel admin Filament, /up, dan halaman
        // error tidak ikut menanggung kuerinya.
        View::composer('layouts.app', function ($view) {
            $view->with('sipasItems', $this->katalog(
                'sipas_items',
                fn () => WasteItem::orderBy('urutan')->get()->map(fn ($i) => $i->toClientArray())
            ));
        });

        // Bank soal hanya dibutuhkan halaman Game & Quiz — halaman lain tak perlu memuatnya.
        View::composer('pages.game', function ($view) {
            $view->with('sipasQuiz', $this->katalog(
                'sipas_quiz',
                fn () => QuizQuestion::where('aktif', true)->orderBy('urutan')->get()
                    ->map(fn ($q) => $q->toClientArray())
            ));
        });
    }

    /**
     * Ambil katalog dari cache. Tanpa ini setiap request menarik ulang seluruh tabel
     * dari Supabase. Cache dibersihkan otomatis saat pengurus menyunting data lewat
     * panel admin (lihat method booted() di model terkait).
     *
     * try/catch: sebelum migrasi dijalankan tabelnya belum ada — JS akan memakai
     * data cadangan bawaan di public/js/data.js.
     *
     * Sengaja disimpan sebagai array biasa, bukan Collection: objek Collection yang
     * di-serialize bisa kembali sebagai __PHP_Incomplete_Class dan membuat @json
     * menghasilkan objek kosong — situs lalu diam-diam jatuh ke data cadangan.
     */
    private function katalog(string $kunci, callable $ambil): array
    {
        try {
            return Cache::remember($kunci, now()->addDay(), fn () => $ambil()->values()->all());
        } catch (\Throwable $e) {
            return [];
        }
    }
}
