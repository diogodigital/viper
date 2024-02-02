<?php

namespace App\Filament\Pages;

use App\Livewire\AdminWidgets;
use App\Livewire\LatestAdminComissions;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Dashboard as BasePage;


class Dashboard extends BasePage implements HasForms
{
    /**
     * @return string|\Illuminate\Contracts\Support\Htmlable|null
     */
    public function getSubheading(): string| null|\Illuminate\Contracts\Support\Htmlable
    {
        if (auth()->user()->hasRole('admin')) {
            return null;
        }

        return 'Olá, afiliado! Seja muito bem-vindo ao seu painel.';
    }

    /**
     * @return string[]
     */
    public function getWidgets(): array
    {
        return [

        ];
    }
}
