<?php

namespace App\Http\Controllers;

use App\Models\ActivityNote;
use App\Models\EducationVideo;
use App\Models\GalleryAlbum;
use App\Models\Member;
use App\Models\Photo;
use App\Models\Poster;
use App\Models\Report;
use App\Models\Schedule;
use App\Models\Umkm;

class PageController extends Controller
{
    public function dashboard()   { return view('pages.dashboard'); }
    public function game()        { return view('pages.game'); }
    public function paparan()
    {
        return view('pages.paparan', [
            'videos'  => EducationVideo::orderBy('urutan')->get(),
            'posters' => Poster::orderBy('urutan')->get(),
        ]);
    }
    public function klasifikasi() { return view('pages.klasifikasi'); }

    public function lokasi()
    {
        return view('pages.lokasi', [
            'reports' => Report::latest()->take(50)->get(),
        ]);
    }

    public function galeri()
    {
        // Album diurutkan dari yang paling awal untuk penomoran "Hari ke-N",
        // lalu dibalik agar kegiatan terbaru tampil paling atas.
        $albums = GalleryAlbum::with('photos')
            ->orderBy('tanggal')->orderBy('urutan')->orderBy('id')
            ->get()
            ->values()
            ->map(function ($album, $i) {
                $album->hari = $i + 1;
                return $album;
            })
            ->reverse()->values();

        $photos = Photo::whereNull('album_id')->latest()->get();

        $months = $albums->map(fn ($a) => $a->tanggal->translatedFormat('F'))
            ->merge($photos->pluck('bulan'))
            ->filter()->unique()->values();

        return view('pages.galeri', [
            'albums' => $albums,
            'photos' => $photos,
            'months' => $months,
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
