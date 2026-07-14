<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:80',
            'deskripsi' => 'nullable|string|max:300',
        ]);
        Umkm::create($data);
        return redirect(route('tentang').'#umkm');
    }

    public function destroy(Umkm $umkm)
    {
        $umkm->delete();
        return redirect(route('tentang').'#umkm');
    }
}
