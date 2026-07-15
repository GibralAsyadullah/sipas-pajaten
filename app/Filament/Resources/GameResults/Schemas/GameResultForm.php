<?php

namespace App\Filament\Resources\GameResults\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

/** Dipakai modal "Lihat" pada tabel hasil (baca saja). */
class GameResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')->label('Nama Responden'),
                TextInput::make('usia'),
                TextInput::make('asal')->label('Dusun / RT / Sekolah'),
                TextInput::make('jenis'),
                TextInput::make('skor'),
                TextInput::make('benar')->label('Jawaban Benar'),
                TextInput::make('total_soal')->label('Total Soal'),
                Textarea::make('detail_teks')
                    ->label('Rincian Jawaban per Soal')
                    ->rows(12)
                    ->columnSpanFull(),
            ]);
    }
}
