<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class WasteItem extends Model
{
    protected $guarded = [];

    /** Suntingan lewat panel admin harus langsung terlihat di situs. */
    protected static function booted(): void
    {
        $segarkan = fn () => Cache::forget('sipas_items');
        static::saved($segarkan);
        static::deleted($segarkan);
    }

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
