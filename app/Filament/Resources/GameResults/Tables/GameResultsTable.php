<?php

namespace App\Filament\Resources\GameResults\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GameResultsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('nama')
                    ->label('Responden')
                    ->searchable(),
                TextColumn::make('usia')
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('asal')
                    ->label('Dusun / RT / Sekolah')
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('jenis')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'game' ? 'success' : 'info')
                    ->formatStateUsing(fn (string $state): string => $state === 'game' ? 'Game Pilah' : 'Quiz'),
                TextColumn::make('skor')
                    ->sortable(),
                TextColumn::make('benar_total')
                    ->label('Benar')
                    ->state(fn ($record) => $record->benar.' / '.$record->total_soal),
                TextColumn::make('created_at')
                    ->label('Waktu Main')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->options([
                        'game' => 'Game Pilah',
                        'quiz' => 'Quiz',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
