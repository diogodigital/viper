<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    /**
     * @return array|Tab[]
     */
    public function getTabs(): array
    {
        return [
            'Todos' => Tab::make(),
            'Essa Semana' => Tab::make()->modifyQueryUsing(fn($query) => $query->where('created_at', '>', now()->subWeek()))->badge(Order::query()->where('created_at', '>', now()->subWeek())->count()),
            'Essa Mês' => Tab::make()->modifyQueryUsing(fn($query) => $query->where('created_at', '>', now()->subMonth()))->badge(Order::query()->where('created_at', '>', now()->subMonth())->count()),
            'Essa Ano' => Tab::make()->modifyQueryUsing(fn($query) => $query->where('created_at', '>', now()->subYear()))->badge(Order::query()->where('created_at', '>', now()->subYear())->count()),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
