<?php

namespace App\Filament\Resources\Photos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('src')
                    ->required(),
                TextInput::make('caption')
                    ->required()
                    ->default('Dokumentasi kegiatan'),
                TextInput::make('bulan'),
                TextInput::make('label'),
            ]);
    }
}
