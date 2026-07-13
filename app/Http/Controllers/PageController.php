<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function dashboard()   { return view('pages.dashboard'); }
    public function lokasi()      { return view('pages.lokasi'); }
    public function game()        { return view('pages.game'); }
    public function paparan()     { return view('pages.paparan'); }
    public function klasifikasi() { return view('pages.klasifikasi'); }
    public function galeri()      { return view('pages.galeri'); }
    public function jadwal()      { return view('pages.jadwal'); }
    public function tentang()     { return view('pages.tentang'); }
}
