<?php

namespace App\Filament\Resources\FiversGameResource\Pages;

use App\Filament\Resources\FiversGameResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFiversGames extends ListRecords
{
    protected static string $resource = FiversGameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
