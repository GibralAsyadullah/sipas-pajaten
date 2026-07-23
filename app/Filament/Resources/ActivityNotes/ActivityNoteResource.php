<?php

namespace App\Filament\Resources\ActivityNotes;

use App\Filament\Resources\ActivityNotes\Pages\CreateActivityNote;
use App\Filament\Resources\ActivityNotes\Pages\EditActivityNote;
use App\Filament\Resources\ActivityNotes\Pages\ListActivityNotes;
use App\Filament\Resources\ActivityNotes\Schemas\ActivityNoteForm;
use App\Filament\Resources\ActivityNotes\Tables\ActivityNotesTable;
use App\Models\ActivityNote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ActivityNoteResource extends Resource
{
    protected static ?string $model = ActivityNote::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ActivityNoteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivityNotesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListActivityNotes::route('/'),
            'create' => CreateActivityNote::route('/create'),
            'edit' => EditActivityNote::route('/{record}/edit'),
        ];
    }
}
