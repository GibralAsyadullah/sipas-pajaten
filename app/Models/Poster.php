<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $guarded = [];

    /** URL publik gambar poster (upload Filament tersimpan di disk public). */
    public function getUrlAttribute(): string
    {
        return asset('storage/'.$this->gambar);
    }
}
