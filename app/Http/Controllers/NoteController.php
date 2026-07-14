<?php

namespace App\Http\Controllers;

use App\Models\ActivityNote;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['isi' => 'required|string|max:500']);
        ActivityNote::create($request->only('isi'));
        return redirect(route('jadwal').'#catatan');
    }

    public function destroy(ActivityNote $note)
    {
        $note->delete();
        return redirect(route('jadwal').'#catatan');
    }
}
