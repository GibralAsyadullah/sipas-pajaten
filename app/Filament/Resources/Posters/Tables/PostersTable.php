<?php

namespace App\Filament\Resources\Posters\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('urutan')
            ->columns([
                TextColumn::make('urutan')
                    ->sortable(),
                ImageColumn::make('gambar')
                    ->disk('public')
                    ->height(70),
                TextColumn::make('judul')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('keterangan')
                    ->limit(40)
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
