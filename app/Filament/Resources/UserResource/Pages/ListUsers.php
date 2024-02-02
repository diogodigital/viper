<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    /**
     * @return string[]
     */
    protected function getHeaderWidgets(): array
    {
        return [
            UserResource\Widgets\UserOverview::class
        ];
    }
}
