<?php

namespace App\Http\Controllers;

use App\Models\GameResult;
use Illuminate\Http\Request;

class GameResultController extends Controller
{
    /** Menyimpan hasil main Game Pilah / Quiz beserta identitas responden. */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'            => 'required|string|max:100',
            'usia'            => 'nullable|integer|min:1|max:120',
            'asal'            => 'nullable|string|max:120',
            'jenis'           => 'required|in:game,quiz,benar_salah',
            'skor'            => 'required|integer|min:0|max:1000',
            'benar'           => 'required|integer|min:0|max:100',
            'total_soal'      => 'required|integer|min:1|max:100',
            'detail'          => 'nullable|array|max:100',
            'detail.*.soal'   => 'required|string|max:300',
            'detail.*.jawab'  => 'required|string|max:300',
            'detail.*.benar'  => 'required|boolean',
        ]);

        $result = GameResult::create($data);

        // Kirim papan juara terbaru agar tampilan bisa diperbarui tanpa reload.
        return response()->json([
            'ok'       => true,
            'id'       => $result->id,
            'top_game' => GameResult::papanJuara('game'),
            'top_quiz' => GameResult::papanJuara('quiz'),
        ]);
    }
}
