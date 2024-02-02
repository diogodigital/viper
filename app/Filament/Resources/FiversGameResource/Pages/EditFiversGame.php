<?php

namespace App\Filament\Resources\FiversGameResource\Pages;

use App\Filament\Resources\FiversGameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFiversGame extends EditRecord
{
    protected static string $resource = FiversGameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
