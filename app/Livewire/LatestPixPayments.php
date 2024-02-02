<?php

namespace App\Livewire;

use App\Models\SuitPayPayment;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPixPayments extends BaseWidget
{
    protected static ?string $heading = 'Pagamentos Realizados';

    protected static ?int $navigationSort = -1;

    protected int | string | array $columnSpan = 'full';

    /**
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(SuitPayPayment::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('payment_id')
                    ->label('Pagamento ID'),
                Tables\Columns\TextColumn::make('pix_key')
                    ->label('Chave Pix'),
                Tables\Columns\TextColumn::make('pix_type')
                    ->label('Tipo de Chave'),
                Tables\Columns\TextColumn::make('amount')
                    ->money('BRL')
                    ->label('Valor'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendente' => 'warning',
                        'pago' => 'success',
                    }),
                Tables\Columns\TextColumn::make('dateHumanReadable')
                    ->label('Data')
            ]);
    }

    /**
     * @return bool
     */
    public static function canView(): bool
    {
        return auth()->user()->hasRole('admin');
    }

}
