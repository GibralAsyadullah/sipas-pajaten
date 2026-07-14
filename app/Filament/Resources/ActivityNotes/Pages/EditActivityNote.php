<?php

namespace App\Filament\Resources\ActivityNotes\Pages;

use App\Filament\Resources\ActivityNotes\ActivityNoteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditActivityNote extends EditRecord
{
    protected static string $resource = ActivityNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
