<?php

namespace App\Filament\Resources\EducationVideos;

use App\Filament\Resources\EducationVideos\Pages\CreateEducationVideo;
use App\Filament\Resources\EducationVideos\Pages\EditEducationVideo;
use App\Filament\Resources\EducationVideos\Pages\ListEducationVideos;
use App\Filament\Resources\EducationVideos\Schemas\EducationVideoForm;
use App\Filament\Resources\EducationVideos\Tables\EducationVideosTable;
use App\Models\EducationVideo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EducationVideoResource extends Resource
{
    protected static ?string $model = EducationVideo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPlayCircle;

    protected static ?string $modelLabel = 'Video Edukasi';

    protected static ?string $pluralModelLabel = 'Video Edukasi';

    public static function form(Schema $schema): Schema
    {
        return EducationVideoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EducationVideosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEducationVideos::route('/'),
            'create' => CreateEducationVideo::route('/create'),
            'edit' => EditEducationVideo::route('/{record}/edit'),
        ];
    }
}
