<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $pollingInterval = '15s';

    protected static bool $isLazy = true;

    /**
     * @return array|Stat[]
     */
    protected function getStats(): array
    {
        $sevenDaysAgo = Carbon::now()->subDays(7);

        $totalApostas = Order::whereIn('type', ['loss', 'bet'])->sum('amount');
        $totalWins = Order::where('type', 'win')->sum('amount');

        $totalWonLast7Days = $totalWins;
        $totalLoseLast7Days = $totalApostas;

        return [
            Stat::make('Total Usuários', User::count())
                ->description('Novos usuários')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([7,3,4,5,6,3,5,3]),
            Stat::make('Total Ganhos', \Helper::amountFormatDecimal($totalWonLast7Days))
                ->description('Ganhos dos usuários')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7,3,4,5,6,3,5,3]),
            Stat::make('Total Perdas', \Helper::amountFormatDecimal($totalLoseLast7Days))
                ->description('Perdas dos usuários')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([7,3,4,5,6,3,5,3])
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
