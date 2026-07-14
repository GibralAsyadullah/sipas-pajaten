<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'foto'    => 'required|image|max:4096',
            'caption' => 'nullable|string|max:160',
        ], [
            'foto.required' => 'Pilih file foto terlebih dahulu.',
            'foto.image'    => 'File harus berupa gambar (jpg/png/webp).',
        ]);

        $path = $request->file('foto')->store('galeri', 'public');

        Photo::create([
            'src'     => 'storage/'.$path,
            'caption' => $request->input('caption') ?: 'Dokumentasi kegiatan',
            'bulan'   => now()->translatedFormat('F'),
            'label'   => now()->translatedFormat('F Y'),
        ]);

        return redirect(route('galeri'))->with('success', '✅ Foto berhasil ditambahkan.');
    }

    public function destroy(Photo $photo)
    {
        if (str_starts_with($photo->src, 'storage/')) {
            Storage::disk('public')->delete(substr($photo->src, strlen('storage/')));
        }
        $photo->delete();
        return redirect(route('galeri'))->with('success', 'Foto dihapus.');
    }
}
