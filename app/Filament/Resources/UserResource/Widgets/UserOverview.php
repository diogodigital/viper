<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends BaseWidget
{
    /**
     * @return array|Stat[]
     */
    protected function getStats(): array
    {
        $totalMonthUsers = User::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $totalWeekUsers = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        return [
            Stat::make('Total Usuários', User::query()->count()),
            Stat::make('Novos semana', $totalWeekUsers),
            Stat::make('Novos mês', $totalMonthUsers),
        ];
    }
}
