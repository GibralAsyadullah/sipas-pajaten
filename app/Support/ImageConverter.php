<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageConverter
{
    /**
     * Simpan foto unggahan sebagai WebP terkompresi di disk public.
     *
     * - Dikecilkan ke lebar maksimum $maxW (proporsional) agar ringan dimuat.
     * - Orientasi EXIF foto HP dikoreksi sebelum disimpan.
     * - Bila format tidak dikenali GD, file asli disimpan apa adanya (fallback).
     */
    public static function toWebp(
        TemporaryUploadedFile $file,
        string $dir,
        int $maxW = 1600,
        int $quality = 80,
    ): string {
        $src  = $file->getRealPath();
        $info = @getimagesize($src);

        if (! $info || ! function_exists('imagewebp')) {
            return $file->store($dir, 'public');
        }

        [$w, $h] = $info;
        $img = match ($info[2]) {
            IMAGETYPE_JPEG => @imagecreatefromjpeg($src),
            IMAGETYPE_PNG  => @imagecreatefrompng($src),
            IMAGETYPE_WEBP => @imagecreatefromwebp($src),
            IMAGETYPE_GIF  => @imagecreatefromgif($src),
            default        => null,
        };

        if (! $img) {
            return $file->store($dir, 'public');
        }

        // Foto HP sering tersimpan miring dengan penanda orientasi EXIF.
        if ($info[2] === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
            $orientation = @exif_read_data($src)['Orientation'] ?? 1;
            $img = match ($orientation) {
                3       => imagerotate($img, 180, 0),
                6       => imagerotate($img, -90, 0),
                8       => imagerotate($img, 90, 0),
                default => $img,
            };
            if (in_array($orientation, [6, 8], true)) {
                [$w, $h] = [$h, $w];
            }
        }

        imagepalettetotruecolor($img);

        if ($w > $maxW) {
            $nw = $maxW;
            $nh = (int) round($h * $maxW / $w);
            $resized = imagecreatetruecolor($nw, $nh);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $img, 0, 0, 0, 0, $nw, $nh, $w, $h);
            imagedestroy($img);
            $img = $resized;
        } else {
            imagealphablending($img, false);
            imagesavealpha($img, true);
        }

        ob_start();
        imagewebp($img, null, $quality);
        $data = ob_get_clean();
        imagedestroy($img);

        if ($data === false || $data === '') {
            return $file->store($dir, 'public');
        }

        $path = $dir.'/'.Str::random(24).'.webp';
        Storage::disk('public')->put($path, $data);

        return $path;
    }
}
