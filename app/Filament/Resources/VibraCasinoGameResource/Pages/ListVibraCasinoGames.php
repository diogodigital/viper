<?php

namespace App\Filament\Resources\VibraCasinoGameResource\Pages;

use App\Filament\Resources\VibraCasinoGameResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVibraCasinoGames extends ListRecords
{
    protected static string $resource = VibraCasinoGameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Novo Jogo Vibra'),
        ];
    }
}
