<?php

namespace App\Filament\Resources\GameExclusiveResource\Pages;

use App\Filament\Resources\GameExclusiveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGameExclusives extends ListRecords
{
    protected static string $resource = GameExclusiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
