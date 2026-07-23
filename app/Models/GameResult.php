<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    protected $guarded = [];

    protected $casts = [
        'detail' => 'array',
    ];

    /**
     * Papan juara: skor tertinggi tiap pemain (satu baris per nama),
     * skor 0 tidak ikut tampil.
     */
    public static function papanJuara(string $jenis, int $limit = 5)
    {
        return static::where('jenis', $jenis)
            ->where('skor', '>', 0)
            ->selectRaw('nama, MAX(skor) as skor')
            ->groupBy('nama')
            ->orderByDesc('skor')
            ->limit($limit)
            ->get();
    }

    /** Rincian jawaban dalam bentuk teks terbaca, dipakai panel admin. */
    public function getDetailTeksAttribute(): string
    {
        return collect($this->detail ?? [])
            ->map(fn ($d, $i) => ($i + 1).'. '.($d['benar'] ? '✅' : '❌').' '
                .($d['soal'] ?? '-').' — jawaban: '.($d['jawab'] ?? '-'))
            ->implode("\n");
    }
}
