<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBanner extends EditRecord
{
    protected static string $resource = BannerResource::class;

    /**
     * @return array|Actions\Action[]|Actions\ActionGroup[]
     */
    protected function getHeaderActions(): array
    {
        return env('APP_DEMO') ? [] : [
            Actions\DeleteAction::make(),
        ];
    }
}
