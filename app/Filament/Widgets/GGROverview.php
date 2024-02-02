<?php

namespace App\Filament\Widgets;

use App\Models\GGRGamesFiver;
use App\Traits\Providers\FiversTrait;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GGROverview extends BaseWidget
{
    use FiversTrait;

    protected function getStats(): array
    {
        $balance = self::getFiversBalance();
        $creditoGastos = GGRGamesFiver::sum('balance_bet');
        $totalPartidas = GGRGamesFiver::count();

        return [
            Stat::make('Créditos Fivers', ($balance ?? '0'))
                ->description('Saldo atual na fivers')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7,3,4,5,6,3,5,3]),
            Stat::make('Créditos Gastos Fivers', \Helper::amountFormatDecimal($creditoGastos))
                ->description('Créditos gastos por usuários')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7,3,4,5,6,3,5,3]),
            Stat::make('Total de Partidas Fivers', $totalPartidas)
                ->description('Total de Partidas Fivers')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7,3,4,5,6,3,5,3]),
        ];
    }

    /**
     * @return bool
     */
    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
