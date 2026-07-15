<?php

namespace App\Filament\Resources\GalleryAlbums\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GalleryAlbumsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('tanggal', 'desc')
            ->columns([
                TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('judul')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('photos_count')
                    ->label('Jumlah Foto')
                    ->counts('photos'),
                TextColumn::make('instagram_url')
                    ->label('Instagram')
                    ->url(fn ($record) => $record->instagram_url, shouldOpenInNewTab: true)
                    ->limit(35)
                    ->placeholder('-'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
