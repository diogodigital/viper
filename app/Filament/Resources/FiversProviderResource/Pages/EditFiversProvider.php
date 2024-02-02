<?php

namespace App\Filament\Resources\FiversProviderResource\Pages;

use App\Filament\Resources\FiversProviderResource;
use App\Traits\Providers\FiversTrait;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditFiversProvider extends EditRecord
{
    use FiversTrait;
    protected static string $resource = FiversProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * @param Model $record
     * @param array $data
     * @return Model
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        self::UpdateRTP($data['rtp'], $data['code']);
        $record->update($data);
        return $record;
    }
}
