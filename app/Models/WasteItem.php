<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteItem extends Model
{
    protected $guarded = [];

    /** Bentuk ringkas yang dipakai JavaScript (klasifikasi, pencarian, game). */
    public function toClientArray(): array
    {
        return [
            'n' => $this->nama,
            'e' => $this->emoji,
            't' => $this->kategori,
            'r' => $this->sumber ?? 'rumah',
            's' => $this->saran,
            'u' => $this->waktu_urai,
            'f' => $this->fakta,
        ];
    }
}
