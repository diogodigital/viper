<?php

namespace App\Filament\Resources\WithdrawalResource\Pages;

use App\Filament\Resources\WithdrawalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWithdrawal extends EditRecord
{
    protected static string $resource = WithdrawalResource::class;

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
