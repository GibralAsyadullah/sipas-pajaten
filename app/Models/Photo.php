<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    /**
     * URL publik foto, apa pun asal path-nya:
     *  - 'img/galeri/..'      → foto bawaan di public/
     *  - 'storage/galeri/..'  → upload dari form Fase 3
     *  - 'galeri/..'          → upload dari Filament FileUpload (disk public)
     */
    public function getUrlAttribute(): string
    {
        if (str_starts_with($this->src, 'img/') || str_starts_with($this->src, 'storage/')) {
            return asset($this->src);
        }

        return asset('storage/'.$this->src);
    }
}
