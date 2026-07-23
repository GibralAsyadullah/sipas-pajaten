<?php

namespace App\Filament\Resources\Schedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('tanggal')
            ->columns([
                TextColumn::make('minggu')
                    ->label('Pekan')
                    ->formatStateUsing(fn ($state) => config("sipas.pekan.{$state}.label") ?? $state)
                    ->sortable(),
                TextColumn::make('tanggal')
                    ->date('D, j M Y')
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('jam')
                    ->placeholder('—'),
                TextColumn::make('judul')
                    ->label('Kegiatan')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('tempat')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => [
                        'done' => 'Selesai', 'ongoing' => 'Berlangsung', 'upcoming' => 'Akan datang',
                    ][$state] ?? $state)
                    ->color(fn ($state) => [
                        'done' => 'success', 'ongoing' => 'warning', 'upcoming' => 'gray',
                    ][$state] ?? 'gray'),
                ImageColumn::make('foto')
                    ->label('Dokumentasi')
                    ->disk('public')
                    ->placeholder('Belum ada'),
                TextColumn::make('urutan')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('minggu')
                    ->label('Pekan')
                    ->options(collect(config('sipas.pekan'))->map(fn ($p) => $p['label'])),
                SelectFilter::make('status')
                    ->options(['done' => 'Selesai', 'ongoing' => 'Berlangsung', 'upcoming' => 'Akan datang']),
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
