<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $guarded = [];

    protected $casts = [
        'opsi'  => 'array',
        'aktif' => 'boolean',
    ];

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
