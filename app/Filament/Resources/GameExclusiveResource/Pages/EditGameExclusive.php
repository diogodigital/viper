<?php

namespace App\Filament\Resources\GameExclusiveResource\Pages;

use App\Filament\Resources\GameExclusiveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGameExclusive extends EditRecord
{
    protected static string $resource = GameExclusiveResource::class;

    protected function getHeaderActions(): array
    {
        return env('APP_DEMO') ? [] :[
            Actions\DeleteAction::make(),
        ];
    }
}
