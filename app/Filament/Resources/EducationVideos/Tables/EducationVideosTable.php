<?php

namespace App\Filament\Resources\EducationVideos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EducationVideosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('urutan')
            ->columns([
                TextColumn::make('urutan')
                    ->sortable(),
                TextColumn::make('judul')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('youtube_url')
                    ->label('Link Video')
                    ->url(fn ($record) => $record->youtube_url, shouldOpenInNewTab: true)
                    ->limit(45),
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
