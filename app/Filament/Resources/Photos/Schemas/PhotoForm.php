<?php

namespace App\Filament\Resources\Photos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('src')
                    ->label('File Foto')
                    ->image()
                    ->disk('public')
                    ->directory('galeri')
                    ->maxSize(4096)
                    ->required()
                    ->columnSpanFull(),
                Select::make('album_id')
                    ->label('Album Kegiatan (opsional)')
                    ->relationship('album', 'judul')
                    ->searchable()
                    ->preload()
                    ->placeholder('Tanpa album — tampil di "Dokumentasi lainnya"'),
                TextInput::make('caption')
                    ->required()
                    ->default('Dokumentasi kegiatan'),
                TextInput::make('bulan')
                    ->helperText('mis. Juni / Juli — dipakai filter galeri untuk foto tanpa album.'),
                TextInput::make('label'),
            ]);
    }
}
