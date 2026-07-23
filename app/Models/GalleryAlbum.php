<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryAlbum extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, 'album_id');
    }
}
