<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;


    /**
     * Posso manipular os dados antes da criação
     * @param array $data
     * @return Model
     */
    protected function handleRecordCreation(array $data): Model
    {
        $data['slug'] = Str::slug($data['name']);

        $checkExistSlug = Category::where('slug', $data['slug'])->first();
        if(!empty($checkExistSlug)) {
            $data['slug'] = $data['slug'] .'-'. time();
        }

        return static::getModel()::create($data);
    }

    /**
     * @return string|null
     */
//    protected function getCreatedNotificationTitle(): ?string
//    {
//        return 'Categoria criada com sucesso!';
//    }

    /**
     * @return Notification|null
     */
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Categoria criada')
            ->body('Categoria criada com sucesso.');
    }

    protected function beforeFill(): void
    {
        // Runs before the form fields are populated with their default values.
    }

    protected function afterFill(): void
    {
        // Runs after the form fields are populated with their default values.
    }

    protected function beforeValidate(): void
    {
        // Runs before the form fields are validated when the form is submitted.
    }

    protected function afterValidate(): void
    {
        // Runs after the form fields are validated when the form is submitted.
    }

    protected function beforeCreate(): void
    {

        // Runs before the form fields are saved to the database.
    }

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
    }
}
