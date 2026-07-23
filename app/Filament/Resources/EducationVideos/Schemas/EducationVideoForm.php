<?php

namespace App\Filament\Resources\EducationVideos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EducationVideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(150)
                    ->placeholder('mis. Cara Memilah Sampah dari Rumah'),
                TextInput::make('youtube_url')
                    ->label('Link Video (YouTube / Google Drive / file langsung)')
                    ->required()
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://youtu.be/… atau https://drive.google.com/file/d/…')
                    ->helperText('Bisa link YouTube (youtu.be, watch?v=, shorts), Google Drive (atur akses berkas jadi "Siapa saja yang memiliki link"), atau link langsung berkas .mp4/.webm.'),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
