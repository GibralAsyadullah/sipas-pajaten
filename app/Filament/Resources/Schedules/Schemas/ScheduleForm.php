<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('periode')
                    ->required(),
                TextInput::make('judul')
                    ->required(),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['done' => 'Done', 'ongoing' => 'Ongoing', 'upcoming' => 'Upcoming'])
                    ->default('upcoming')
                    ->required(),
                TextInput::make('ikon')
                    ->required()
                    ->default('?'),
                TextInput::make('urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
