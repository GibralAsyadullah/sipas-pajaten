<?php

namespace App\Filament\Resources\Photos\Schemas;

use App\Support\ImageConverter;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('src')
                    ->label('File Foto')
                    ->helperText('Foto otomatis dikompres & dikonversi ke WebP saat disimpan. Format: JPG/PNG/WebP — foto iPhone (HEIC) harap disimpan ulang sebagai JPG dulu.')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->disk('public')
                    ->directory('galeri')
                    ->maxSize(8192)
                    ->saveUploadedFileUsing(fn (TemporaryUploadedFile $file) => ImageConverter::toWebp($file, 'galeri'))
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
