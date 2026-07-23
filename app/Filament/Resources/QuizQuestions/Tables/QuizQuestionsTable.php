<?php

namespace App\Filament\Resources\QuizQuestions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuizQuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('urutan')
            ->columns([
                TextColumn::make('urutan')
                    ->sortable(),
                TextColumn::make('pertanyaan')
                    ->searchable()
                    ->wrap()
                    ->limit(90),
                TextColumn::make('jawaban_teks')
                    ->label('Jawaban Benar')
                    ->state(fn ($record) => $record->opsi[$record->jawaban] ?? '-')
                    ->wrap(),
                IconColumn::make('aktif')
                    ->boolean(),
            ])
            ->filters([
                //
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
