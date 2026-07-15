<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    protected $guarded = [];

    protected $casts = [
        'detail' => 'array',
    ];

    /** Rincian jawaban dalam bentuk teks terbaca, dipakai panel admin. */
    public function getDetailTeksAttribute(): string
    {
        return collect($this->detail ?? [])
            ->map(fn ($d, $i) => ($i + 1).'. '.($d['benar'] ? '✅' : '❌').' '
                .($d['soal'] ?? '-').' — jawaban: '.($d['jawab'] ?? '-'))
            ->implode("\n");
    }
}
