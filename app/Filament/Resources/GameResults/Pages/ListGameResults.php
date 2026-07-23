<?php

namespace App\Filament\Resources\GameResults\Pages;

use App\Filament\Resources\GameResults\GameResultResource;
use App\Models\GameResult;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListGameResults extends ListRecords
{
    protected static string $resource = GameResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('hapusSemua')
                ->label('Hapus Semua Riwayat')
                ->icon(Heroicon::OutlinedTrash)
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Hapus semua riwayat game & quiz?')
                ->modalDescription('Seluruh hasil game dan quiz akan dihapus permanen — termasuk papan juara. Tindakan ini tidak bisa dibatalkan.')
                ->modalSubmitActionLabel('Ya, hapus semua')
                ->visible(fn (): bool => GameResult::exists())
                ->action(function (): void {
                    GameResult::query()->delete();

                    Notification::make()
                        ->title('Semua riwayat game & quiz telah dihapus')
                        ->success()
                        ->send();
                }),
        ];
    }
}
