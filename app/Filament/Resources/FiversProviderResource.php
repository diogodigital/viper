<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FiversProviderResource\Pages;
use App\Filament\Resources\FiversProviderResource\RelationManagers;
use App\Models\FiversProvider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FiversProviderResource extends Resource
{
    protected static ?string $model = FiversProvider::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?string $navigationLabel = 'Provedores';

    protected static ?string $modelLabel = 'Provedores';

    protected static ?string $navigationGroup = 'Fivers';

    protected static ?string $slug = 'fivers-provedores';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('code')
                        ->maxLength(50),
                    Forms\Components\TextInput::make('name')
                        ->maxLength(50),
                    Forms\Components\TextInput::make('rtp')
                        ->numeric()
                        ->minValue(50)
                        ->maxLength(50),
                    Forms\Components\TextInput::make('status')
                        ->required()
                        ->maxLength(191)
                        ->default(1),
                ])->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rtp')->suffix('%'),
                Tables\Columns\ToggleColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFiversProviders::route('/'),
            'create' => Pages\CreateFiversProvider::route('/create'),
            'edit' => Pages\EditFiversProvider::route('/{record}/edit'),
        ];
    }
}
