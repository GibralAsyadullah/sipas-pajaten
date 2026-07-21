<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class QuizQuestion extends Model
{
    protected $guarded = [];

    protected $casts = [
        'opsi'  => 'array',
        'aktif' => 'boolean',
    ];

    /** Suntingan lewat panel admin harus langsung terlihat di halaman Game & Quiz. */
    protected static function booted(): void
    {
        $segarkan = fn () => Cache::forget('sipas_quiz');
        static::saved($segarkan);
        static::deleted($segarkan);
    }

    /** Bentuk ringkas yang dipakai JavaScript pada halaman Game & Quiz. */
    public function toClientArray(): array
    {
        return [
            'q'  => $this->pertanyaan,
            'o'  => $this->opsi,
            'a'  => (int) $this->jawaban,
            'ex' => $this->penjelasan ?? '',
        ];
    }
}
