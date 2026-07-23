<?php

namespace App\Filament\Resources\EducationVideos\Pages;

use App\Filament\Resources\EducationVideos\EducationVideoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEducationVideo extends EditRecord
{
    protected static string $resource = EducationVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
