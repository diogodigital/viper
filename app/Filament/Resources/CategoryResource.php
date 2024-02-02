<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?string $navigationLabel = 'Categorias';

    protected static ?string $modelLabel = 'Categorias';

    protected static ?string $navigationGroup = 'Meus Jogos';

    protected static ?int $navigationSort = 1;

    /**
     * @param Form $form
     * @return Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Categorias')
                    ->description('Informações da categoria')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->placeholder('Digite o nome da categoria')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\TextInput::make('description')
                            ->placeholder('Digite a descrição da categoria')
                            ->required()
                            ->maxLength(191),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('uploads')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])
                ]);
    }

    /**
     * @param Table $table
     * @return Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->size(20)
                    ->label('Imagem'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(80)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('name', 'desc')
            ->filters([
                //
            ])
            ->actions(env('APP_DEMO') ? [
                Tables\Actions\ViewAction::make(),
            ] : [
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions(env('APP_DEMO') ? [] : [
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    /**
     * @return array|\Filament\Resources\RelationManagers\RelationGroup[]|\Filament\Resources\RelationManagers\RelationManagerConfiguration[]|string[]
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * @return array|\Filament\Resources\Pages\PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
