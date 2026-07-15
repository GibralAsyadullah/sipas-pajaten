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
                    ->label('Link YouTube')
                    ->required()
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://youtu.be/XXXXXXXXXXX')
                    ->helperText('Format yang dikenali: youtu.be/…, youtube.com/watch?v=…, shorts, atau embed.'),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
