<?php

namespace App\Http\Controllers;

use App\Models\ActivityNote;
use App\Models\EducationVideo;
use App\Models\GalleryAlbum;
use App\Models\GameResult;
use App\Models\Member;
use App\Models\Photo;
use App\Models\Poster;
use App\Models\Schedule;
use Illuminate\Support\Carbon;

class PageController extends Controller
{
    public function dashboard()   { return view('pages.dashboard'); }
    public function game()
    {
        return view('pages.game', [
            'topGame' => GameResult::papanJuara('game'),
            'topQuiz' => GameResult::papanJuara('quiz'),
        ]);
    }
    public function paparan()
    {
        return view('pages.paparan', [
            'videos'  => EducationVideo::orderBy('urutan')->get(),
            'posters' => Poster::orderBy('urutan')->get(),
        ]);
    }
    public function klasifikasi() { return view('pages.klasifikasi'); }

    public function lokasi()      { return view('pages.lokasi'); }

    public function galeri()
    {
        // Album diurutkan dari yang paling awal untuk penomoran "Hari ke-N",
        // lalu dibalik agar kegiatan terbaru tampil paling atas.
        // Album sebelum pembukaan KKN (8 Juli) diberi label "Pra-KKN", bukan nomor hari.
        $mulaiKkn = Carbon::parse('2026-07-08');
        $nHari = 0;
        $albums = GalleryAlbum::with('photos')
            ->orderBy('tanggal')->orderBy('urutan')->orderBy('id')
            ->get()
            ->values()
            ->map(function ($album) use (&$nHari, $mulaiKkn) {
                $album->hari = $album->tanggal->gte($mulaiKkn) ? ++$nHari : null;
                return $album;
            })
            ->reverse()->values();

        // Foto lepas dipisah: kolase feed Instagram tampil sebagai grid ala IG,
        // sisanya masuk "Dokumentasi Lainnya".
        [$igFeed, $photos] = Photo::whereNull('album_id')->orderBy('id')->get()
            ->partition(fn ($p) => $p->label === 'Feed Instagram');
        $photos = $photos->sortByDesc('created_at')->values();

        $months = $albums->map(fn ($a) => $a->tanggal->translatedFormat('F'))
            ->merge($photos->pluck('bulan'))
            ->filter()->unique()->values();

        return view('pages.galeri', [
            'albums' => $albums,
            'photos' => $photos,
            'igFeed' => $igFeed->values(),
            'months' => $months,
        ]);
    }

    public function jadwal()
    {
        $schedules = Schedule::orderBy('minggu')->orderBy('urutan')->get();
        $total = $schedules->count();
        $done  = $schedules->where('status', 'done')->count();

        // Setiap pekan rundown selalu tampil, termasuk yang agendanya masih kosong.
        $pekan = collect(config('sipas.pekan'))->map(fn ($meta, $no) => $meta + [
            'no'      => $no,
            'agenda'  => $schedules->where('minggu', $no)->values(),
        ])->values();

        return view('pages.jadwal', [
            'pekan'    => $pekan,
            'kalender' => $this->buildKalender($schedules),
            'notes'    => ActivityNote::latest()->get(),
            'jTotal'   => $total,
            'jDone'    => $done,
            'jPct'     => $total ? (int) round($done / $total * 100) : 0,
        ]);
    }

    /**
     * Susun grid kalender bulanan (Senin-Minggu) yang mencakup seluruh
     * rentang tanggal agenda; jatuh ke periode KKN bila belum ada agenda.
     */
    private function buildKalender($schedules): array
    {
        $berTanggal = $schedules->filter(fn ($s) => $s->tanggal);

        // Selalu mencakup periode KKN penuh (8 Juli - 8 Agustus 2026); melebar
        // bila ada agenda di luar rentang itu.
        $mulai   = collect([$berTanggal->min('tanggal'), Carbon::parse('2026-07-08')])
            ->filter()->min()->copy()->startOfMonth();
        $selesai = collect([$berTanggal->max('tanggal'), Carbon::parse('2026-08-08')])
            ->filter()->max()->copy()->startOfMonth();

        $bulan = [];
        for ($b = $mulai->copy(); $b->lte($selesai); $b->addMonth()) {
            $hari  = [];
            $awal  = $b->copy()->startOfWeek(Carbon::MONDAY);
            $akhir = $b->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

            for ($h = $awal->copy(); $h->lte($akhir); $h->addDay()) {
                $hari[] = [
                    'tanggal' => $h->copy(),
                    'bulanIni' => $h->month === $b->month,
                    'agenda'  => $berTanggal->filter(fn ($s) => $s->tanggal->isSameDay($h))->values(),
                ];
            }

            $bulan[] = ['label' => $b->translatedFormat('F Y'), 'hari' => $hari];
        }

        return $bulan;
    }

    public function tentang()
    {
        return view('pages.tentang', [
            'members' => Member::orderBy('urutan')->get(),
        ]);
    }
}
