<?php

namespace App\Filament\Resources\Posters\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PosterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(150)
                    ->placeholder('mis. Ayo Pilah Sampahmu!'),
                FileUpload::make('gambar')
                    ->label('File Poster (gambar)')
                    ->image()
                    ->disk('public')
                    ->directory('poster')
                    ->maxSize(4096)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('keterangan')
                    ->maxLength(255)
                    ->placeholder('Keterangan singkat (opsional)'),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
