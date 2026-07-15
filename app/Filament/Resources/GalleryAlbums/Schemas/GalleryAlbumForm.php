<?php

namespace App\Filament\Resources\GalleryAlbums\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryAlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(180)
                    ->placeholder('mis. Pelepasan KKN di UBP Karawang & Desa Pajaten'),
                DatePicker::make('tanggal')
                    ->required()
                    ->default(now()),
                Textarea::make('cerita')
                    ->label('Cerita singkat (boleh salin caption Instagram)')
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('instagram_url')
                    ->label('Link post Instagram (opsional)')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://www.instagram.com/p/…'),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka kecil tampil lebih dulu; kosongkan saja bila urut tanggal sudah cukup.'),
            ]);
    }
}
