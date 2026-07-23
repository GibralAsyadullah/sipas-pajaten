<?php

namespace App\Filament\Resources\ActivityNotes\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ActivityNoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('isi')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
