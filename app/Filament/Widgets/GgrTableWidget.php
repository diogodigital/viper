<?php

namespace App\Filament\Widgets;

use App\Models\GGRGamesFiver;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class GgrTableWidget extends BaseWidget
{

    protected static ?string $heading = 'GGR Fivers';

    protected static ?int $navigationSort = -1;

    protected int | string | array $columnSpan = 'full';

    /**
     * @param Table $table
     * @return Table
     */
    public function table(Table $table): Table
    {
        return $table
            ->query(GGRGamesFiver::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuário'),
                Tables\Columns\TextColumn::make('provider')
                    ->label('Provedor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('game')
                    ->label('Jogo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('balance_bet')
                    ->money('BRL')
                    ->label('Saldo Aposta'),
                Tables\Columns\TextColumn::make('balance_win')
                    ->money('BRL')
                    ->label('Saldo Vitoria'),
                Tables\Columns\TextColumn::make('dateHumanReadable')
                    ->label('Data')
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->label('Data Inicial'),
                        DatePicker::make('created_until')->label('Data Final'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Criação Inicial ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }

                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Criação Final ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ;
    }
}
