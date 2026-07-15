<?php

namespace App\Providers;

use App\Models\QuizQuestion;
use App\Models\WasteItem;
use Illuminate\Support\Facades\Schema;
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
        // Data klasifikasi sampah dari database, dibagikan ke semua halaman.
        // try/catch agar website tetap jalan sebelum migrasi dijalankan.
        try {
            if (Schema::hasTable('waste_items')) {
                View::share('sipasItems', WasteItem::orderBy('urutan')->get()
                    ->map(fn ($i) => $i->toClientArray())->values());
            }

            // Bank soal quiz dari database, dipakai halaman Game & Quiz.
            if (Schema::hasTable('quiz_questions')) {
                View::share('sipasQuiz', QuizQuestion::where('aktif', true)
                    ->orderBy('urutan')->get()
                    ->map(fn ($q) => $q->toClientArray())->values());
            }
        } catch (\Throwable $e) {
            // biarkan JS memakai data cadangan bawaan
        }
    }
}
