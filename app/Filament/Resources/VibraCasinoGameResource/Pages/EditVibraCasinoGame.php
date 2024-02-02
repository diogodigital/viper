<?php

namespace App\Filament\Resources\VibraCasinoGameResource\Pages;

use App\Filament\Resources\VibraCasinoGameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVibraCasinoGame extends EditRecord
{
    protected static string $resource = VibraCasinoGameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
