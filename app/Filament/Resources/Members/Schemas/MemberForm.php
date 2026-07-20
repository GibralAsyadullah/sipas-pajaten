<?php

namespace App\Filament\Resources\Members\Schemas;

use App\Support\ImageConverter;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('peran')
                    ->required()
                    ->default('Anggota'),
                TextInput::make('prodi')
                    ->label('Program studi')
                    ->placeholder('mis. Teknik Informatika')
                    ->maxLength(100),
                FileUpload::make('foto')
                    ->label('Foto anggota')
                    ->helperText('Opsional — bila kosong, kartu anggota menampilkan inisial nama. Foto otomatis dikompres ke WebP (format: JPG/PNG/WebP).')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->avatar()
                    ->disk('public')
                    ->directory('anggota')
                    ->maxSize(8192)
                    ->saveUploadedFileUsing(fn (TemporaryUploadedFile $file) => ImageConverter::toWebp($file, 'anggota', 600))
                    ->columnSpanFull(),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
