<?php

namespace App\Filament\Resources\QuizQuestions\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuizQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('opsi')
                    ->label('Pilihan Jawaban')
                    ->simple(
                        TextInput::make('opsi')->required()->maxLength(200)
                    )
                    ->minItems(2)
                    ->maxItems(6)
                    ->defaultItems(4)
                    ->columnSpanFull(),
                Select::make('jawaban')
                    ->label('Jawaban Benar')
                    ->options([
                        0 => 'Pilihan ke-1',
                        1 => 'Pilihan ke-2',
                        2 => 'Pilihan ke-3',
                        3 => 'Pilihan ke-4',
                        4 => 'Pilihan ke-5',
                        5 => 'Pilihan ke-6',
                    ])
                    ->required(),
                Textarea::make('penjelasan')
                    ->label('Penjelasan (tampil setelah menjawab)')
                    ->columnSpanFull(),
                Toggle::make('aktif')
                    ->label('Aktif (ikut diundi di quiz)')
                    ->default(true),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
