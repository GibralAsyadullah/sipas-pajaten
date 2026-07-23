<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    /**
     * URL foto anggota, mengikuti pola Schedule::getFotoUrlAttribute().
     */
    public function getFotoUrlAttribute(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        if (str_starts_with($this->foto, 'img/') || str_starts_with($this->foto, 'storage/')) {
            return asset($this->foto);
        }

        return asset('storage/'.$this->foto);
    }
}
