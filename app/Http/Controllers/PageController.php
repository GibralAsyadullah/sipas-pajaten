<?php

namespace App\Http\Controllers;

use App\Models\ActivityNote;
use App\Models\Member;
use App\Models\Photo;
use App\Models\Report;
use App\Models\Schedule;
use App\Models\Umkm;

class PageController extends Controller
{
    public function dashboard()   { return view('pages.dashboard'); }
    public function game()        { return view('pages.game'); }
    public function paparan()     { return view('pages.paparan'); }
    public function klasifikasi() { return view('pages.klasifikasi'); }

    public function lokasi()
    {
        return view('pages.lokasi', [
            'reports' => Report::latest()->take(50)->get(),
        ]);
    }

    public function galeri()
    {
        return view('pages.galeri', [
            'photos' => Photo::latest()->get(),
        ]);
    }

    public function jadwal()
    {
        $schedules = Schedule::orderBy('urutan')->get();
        $total = $schedules->where('status', '!=', 'ongoing')->count();
        $done  = $schedules->where('status', 'done')->count();

        return view('pages.jadwal', [
            'schedules' => $schedules,
            'notes'     => ActivityNote::latest()->get(),
            'jTotal'    => $total,
            'jDone'     => $done,
            'jPct'      => $total ? (int) round($done / $total * 100) : 0,
        ]);
    }

    public function tentang()
    {
        return view('pages.tentang', [
            'members' => Member::orderBy('urutan')->get(),
            'umkms'   => Umkm::orderBy('id')->get(),
        ]);
    }
}
