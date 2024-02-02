<?php

namespace App\Filament\Resources\FiversProviderResource\Pages;

use App\Filament\Resources\FiversProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFiversProviders extends ListRecords
{
    protected static string $resource = FiversProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
