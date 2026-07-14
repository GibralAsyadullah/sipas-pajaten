<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => 'required|string|max:60',
            'peran' => 'nullable|string|max:80',
        ]);
        Member::create([
            'nama'   => $data['nama'],
            'peran'  => $data['peran'] ?: 'Anggota',
            'urutan' => (Member::max('urutan') ?? 0) + 1,
        ]);
        return redirect(route('tentang').'#anggota');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect(route('tentang').'#anggota');
    }
}
