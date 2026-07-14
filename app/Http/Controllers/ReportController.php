<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'lokasi'    => 'required|string|max:200',
            'deskripsi' => 'nullable|string|max:1000',
        ], [
            'lokasi.required' => 'Isi dulu lokasi tumpukan sampahnya, ya.',
        ]);

        Report::create($data);

        $flash = ['success' => '✅ Laporan tersimpan & diteruskan ke tim. Terima kasih!'];

        if ($request->input('mode') === 'wa') {
            $tgl  = now()->translatedFormat('j F Y');
            $text = "🗑️ *LAPORAN TUMPUKAN SAMPAH*\nDesa Pajaten, Cibuaya\n\n📍 Lokasi: {$data['lokasi']}\n📝 Keterangan: ".($data['deskripsi'] ?: '-')."\n🗓️ {$tgl}\n\n(Dikirim via SIPAS Pajaten)";
            $flash['wa_url']  = 'https://wa.me/?text='.rawurlencode($text);
            $flash['success'] = '✅ Laporan tersimpan. Klik tombol di bawah untuk meneruskan via WhatsApp.';
        }

        return redirect(route('lokasi').'#lapor')->with($flash);
    }

    public function update(Request $request, Report $report)
    {
        $request->validate(['status' => 'required|in:baru,diproses,selesai']);
        $report->update(['status' => $request->status]);
        return redirect(route('lokasi').'#kelola');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect(route('lokasi').'#kelola');
    }
}
