<?php

namespace App\Filament\Resources\Umkms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UmkmForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('emoji')
                    ->required()
                    ->default('?'),
                TextInput::make('nama')
                    ->required(),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
                TextInput::make('tag'),
            ]);
    }
}
