<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationVideo extends Model
{
    protected $guarded = [];

    /** Ambil ID video dari berbagai bentuk link YouTube (youtu.be, watch?v=, shorts, embed). */
    public function getYoutubeIdAttribute(): ?string
    {
        if (! str_contains($this->youtube_url, 'youtu')) {
            return null;
        }

        preg_match('~(?:youtu\.be/|v=|shorts/|embed/)([A-Za-z0-9_-]{11})~', $this->youtube_url, $m);

        return $m[1] ?? null;
    }

    /** ID berkas dari berbagai bentuk link Google Drive (file/d/…, open?id=, uc?id=). */
    public function getDriveIdAttribute(): ?string
    {
        preg_match('~drive\.google\.com/(?:file/d/|open\?id=|uc\?(?:[\w=&]*?)id=)([A-Za-z0-9_-]{10,})~', $this->youtube_url, $m);

        return $m[1] ?? null;
    }

    /** Link berkas video langsung (mp4/webm/ogg) — diputar dengan tag <video>. */
    public function getIsFileAttribute(): bool
    {
        return (bool) preg_match('~\.(mp4|webm|ogg)(\?.*)?$~i', $this->youtube_url);
    }

    /** URL siap-embed untuk iframe: YouTube atau Google Drive. */
    public function getEmbedUrlAttribute(): ?string
    {
        if ($this->youtube_id) {
            return 'https://www.youtube.com/embed/'.$this->youtube_id.'?rel=0';
        }

        if ($this->drive_id) {
            return 'https://drive.google.com/file/d/'.$this->drive_id.'/preview';
        }

        return null;
    }

    /** Gambar sampul video — dipakai sebagai pemantik sebelum iframe dimuat. */
    public function getThumbUrlAttribute(): ?string
    {
        if ($this->youtube_id) {
            return 'https://i.ytimg.com/vi/'.$this->youtube_id.'/hqdefault.jpg';
        }

        if ($this->drive_id) {
            return 'https://drive.google.com/thumbnail?id='.$this->drive_id.'&sz=w800';
        }

        return null;
    }

    /** Link untuk dibuka di tab baru bila embed gagal dimuat. */
    public function getWatchUrlAttribute(): string
    {
        if ($this->youtube_id) {
            return 'https://www.youtube.com/watch?v='.$this->youtube_id;
        }

        if ($this->drive_id) {
            return 'https://drive.google.com/file/d/'.$this->drive_id.'/view';
        }

        return $this->youtube_url;
    }

    /** Nama layanan sumber video, untuk label tombol cadangan. */
    public function getProviderAttribute(): string
    {
        if ($this->youtube_id) {
            return 'YouTube';
        }

        if ($this->drive_id) {
            return 'Google Drive';
        }

        return 'tab baru';
    }
}
