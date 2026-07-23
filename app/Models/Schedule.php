<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Label waktu kartu agenda: pakai tanggal asli bila ada, selain itu jatuh
     * ke 'periode' untuk agenda rutin tanpa tanggal pasti.
     */
    public function getLabelWaktuAttribute(): string
    {
        if (! $this->tanggal) {
            return $this->periode ?: '';
        }

        $label = $this->tanggal->translatedFormat('l, j F Y');

        return $this->jam ? $label.' · '.$this->jam : $label;
    }

    /**
     * URL foto dokumentasi, mengikuti pola Photo::getUrlAttribute().
     */
    public function getFotoUrlAttribute(): ?string
    {
        return $this->resolveFotoUrl($this->foto);
    }

    /**
     * Semua URL foto dokumentasi (foto & foto_2) yang terisi.
     */
    public function getFotoUrlsAttribute(): array
    {
        return array_values(array_filter([
            $this->resolveFotoUrl($this->foto),
            $this->resolveFotoUrl($this->foto_2),
        ]));
    }

    private function resolveFotoUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (! str_starts_with($path, 'img/') && ! str_starts_with($path, 'storage/')) {
            $path = 'storage/'.$path;
        }

        // File hilang atau 0 byte (upload gagal) jangan dirender sebagai kotak rusak.
        $abs = public_path($path);
        if (! is_file($abs) || filesize($abs) === 0) {
            return null;
        }

        return asset($path);
    }
}
