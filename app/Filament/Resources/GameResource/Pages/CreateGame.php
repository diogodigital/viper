<?php

namespace App\Filament\Resources\GameResource\Pages;

use App\Filament\Resources\GameResource;
use App\Models\Game;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateGame extends CreateRecord
{
    protected static string $resource = GameResource::class;

    /**
     * Posso manipular os dados antes da criação
     * @param array $data
     * @return Model
     */
    protected function handleRecordCreation(array $data): Model
    {
        $data['slug'] = Str::slug($data['provider'].' '.$data['name']);

        $checkExistSlug = Game::where('slug', $data['slug'])->first();
        if(!empty($checkExistSlug)) {
            $data['slug'] = $data['slug'] .'-'. time();
        }

        return static::getModel()::create($data);
    }

    /**
     * @return Notification|null
     */
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Jogo criado.')
            ->body('Jogo criado com sucesso!');
    }
}
