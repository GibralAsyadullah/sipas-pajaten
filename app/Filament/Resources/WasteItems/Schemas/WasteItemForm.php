<?php

namespace App\Filament\Resources\WasteItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class WasteItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('emoji')
                    ->required()
                    ->default('?️'),
                Select::make('kategori')
                    ->options(['organik' => 'Organik', 'anorganik' => 'Anorganik', 'b3' => 'B3'])
                    ->required(),
                TextInput::make('saran')
                    ->required(),
                TextInput::make('waktu_urai'),
                Textarea::make('fakta')
                    ->columnSpanFull(),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
