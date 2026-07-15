<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationVideo extends Model
{
    protected $guarded = [];

    /** Ambil ID video dari berbagai bentuk link YouTube (youtu.be, watch?v=, shorts, embed). */
    public function getYoutubeIdAttribute(): ?string
    {
        preg_match('~(?:youtu\.be/|v=|shorts/|embed/)([A-Za-z0-9_-]{11})~', $this->youtube_url, $m);

        return $m[1] ?? null;
    }
}
