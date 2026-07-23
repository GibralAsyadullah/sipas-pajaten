<?php

namespace App\Filament\Resources\ActivityNotes\Pages;

use App\Filament\Resources\ActivityNotes\ActivityNoteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListActivityNotes extends ListRecords
{
    protected static string $resource = ActivityNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
