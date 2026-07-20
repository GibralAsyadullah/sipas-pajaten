<?php

namespace App\Filament\Resources\Posters\Schemas;

use App\Support\ImageConverter;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

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
                    ->helperText('Gambar otomatis dikompres & dikonversi ke WebP saat disimpan (format: JPG/PNG/WebP).')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->disk('public')
                    ->directory('poster')
                    ->maxSize(8192)
                    ->saveUploadedFileUsing(fn (TemporaryUploadedFile $file) => ImageConverter::toWebp($file, 'poster'))
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
