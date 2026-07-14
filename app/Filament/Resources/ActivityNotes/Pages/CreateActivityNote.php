<?php

namespace App\Filament\Resources\ActivityNotes\Pages;

use App\Filament\Resources\ActivityNotes\ActivityNoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateActivityNote extends CreateRecord
{
    protected static string $resource = ActivityNoteResource::class;
}
