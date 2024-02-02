<?php

namespace App\Livewire;

use App\Models\Deposit;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WalletOverview extends BaseWidget
{
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        $setting = \Helper::getSetting();
        // Obtém a data atual
        $dataAtual = Carbon::now();

        $sumDepositMonth = Deposit::whereYear('created_at', $dataAtual->year)
            ->whereMonth('created_at', $dataAtual->month)
            ->where('status', 1)
            ->sum('amount');

        $sumWithdrawalMonth = Withdrawal::whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        $revshare = \Helper::porcentagem_xn($setting->revshare_percentage, $sumDepositMonth);

        return [
            Stat::make('Depositos', \Helper::amountFormatDecimal($sumDepositMonth))
                ->description('Total de Depositos')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Saques', \Helper::amountFormatDecimal($sumWithdrawalMonth))
                ->description('Total de saques')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Revshare', \Helper::amountFormatDecimal($revshare))
                ->description('Ganhos da Plataforma')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
