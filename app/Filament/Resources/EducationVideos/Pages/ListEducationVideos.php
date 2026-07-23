<?php

namespace App\Filament\Resources\EducationVideos\Pages;

use App\Filament\Resources\EducationVideos\EducationVideoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEducationVideos extends ListRecords
{
    protected static string $resource = EducationVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
