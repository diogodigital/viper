<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Exceptions\Halt;
use Illuminate\Database\Eloquent\Model;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    /**
     * @return array|Actions\Action[]|Actions\ActionGroup[]
     */
    protected function getHeaderActions(): array
    {
        return env('APP_DEMO') ? [] : [
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
        $record->update($data);

        return $record;
    }

}
