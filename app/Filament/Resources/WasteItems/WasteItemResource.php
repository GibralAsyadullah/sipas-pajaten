<?php

namespace App\Filament\Resources\WasteItems;

use App\Filament\Resources\WasteItems\Pages\CreateWasteItem;
use App\Filament\Resources\WasteItems\Pages\EditWasteItem;
use App\Filament\Resources\WasteItems\Pages\ListWasteItems;
use App\Filament\Resources\WasteItems\Schemas\WasteItemForm;
use App\Filament\Resources\WasteItems\Tables\WasteItemsTable;
use App\Models\WasteItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WasteItemResource extends Resource
{
    protected static ?string $model = WasteItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WasteItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WasteItemsTable::configure($table);
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
            'index' => ListWasteItems::route('/'),
            'create' => CreateWasteItem::route('/create'),
            'edit' => EditWasteItem::route('/{record}/edit'),
        ];
    }
}
