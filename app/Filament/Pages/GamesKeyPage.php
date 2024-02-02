<?php

namespace App\Filament\Pages;

use App\Models\GamesKey;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Notifications\Notification;

class GamesKeyPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.games-key-page';

    protected static ?string $title = 'Chaves dos Jogos';

    protected static ?string $slug = 'chaves-dos-jogos';


    public ?array $data = [];
    public ?GamesKey $setting;

    /**
     * @return void
     */
    public function mount(): void
    {
        $gamesKey = GamesKey::first();
        if(!empty($gamesKey)) {
            $this->setting = $gamesKey;
            $this->form->fill($this->setting->toArray());
        }else{
            $this->form->fill();
        }
    }

    /**
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Slotegrator API')
                    ->description('Ajustes de credenciais para a Slotegrator')
                    ->schema([
                        TextInput::make('merchant_url')
                            ->label('Merchant URL')
                            ->placeholder('Digite aqui a URL da API')
                            ->maxLength(191)
                            ->columnSpanFull(),
                        TextInput::make('merchant_id')
                            ->label('Merchant ID')
                            ->placeholder('Digite aqui a Merchant ID')
                            ->maxLength(191),
                        TextInput::make('merchant_key')
                            ->placeholder('Digite aqui a Merchant Key')
                            ->label('Merchant Key')
                            ->maxLength(191),
                    ])
                    ->columns(2),

                Section::make('Fivers API')
                    ->description('Ajustes de credenciais para a Fivers')
                    ->schema([
                        TextInput::make('agent_code')
                            ->label('Agent Code')
                            ->placeholder('Digite aqui o Agent Code')
                            ->maxLength(191),
                        TextInput::make('agent_token')
                            ->label('Agent Token')
                            ->placeholder('Digite aqui o Agent Token')
                            ->maxLength(191),
                        TextInput::make('agent_secret_key')
                            ->label('Agent Secret Key')
                            ->placeholder('Digite aqui o Agent Secret Key')
                            ->maxLength(191),
                        TextInput::make('api_endpoint')
                            ->label('Api Endpoint')
                            ->placeholder('Digite aqui a API Endpoint')
                            ->maxLength(191)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Section::make('Salsa API')
                    ->description('Ajustes de credenciais para a Salsa. Site do provedor: https://salsatechnology.com/')
                    ->schema([
                        TextInput::make('salsa_base_uri')
                            ->label('Salsa URI')
                            ->placeholder('Digite aqui a Base URL Salsa')
                            ->maxLength(191),
                        TextInput::make('salsa_pn')
                            ->label('Salsa PN')
                            ->placeholder('Digite aqui o PN')
                            ->maxLength(191),
                        TextInput::make('salsa_key')
                            ->label('Salsa Key')
                            ->placeholder('Digite aqui o Salsa Key')
                            ->maxLength(191),
                    ])
                    ->columns(3),

                Section::make('Vibra Gaming API')
                    ->description('Ajustes de credenciais para a Vibra Gaming Casino. Site do provedor: https://vibragaming.com/')
                    ->schema([
                        TextInput::make('vibra_site_id')
                            ->label('Vibra Site ID')
                            ->placeholder('Digite aqui o Vibra Site ID')
                            ->maxLength(191),
                        TextInput::make('vibra_game_mode')
                            ->label('Vibra Game Mode')
                            ->placeholder('Digite o Vibra Game Mode')
                            ->maxLength(191),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }


    /**
     * @return void
     */
    public function submit(): void
    {
        try {
            if(env('APP_DEMO')) {
                Notification::make()
                    ->title('Atenção')
                    ->body('Você não pode realizar está alteração na versão demo')
                    ->danger()
                    ->send();
                return;
            }

            $setting = GamesKey::first();
            if(!empty($setting)) {
                if($setting->update($this->data)) {
                    Notification::make()
                        ->title('Chaves Alteradas')
                        ->body('Suas chaves foram alteradas com sucesso!')
                        ->success()
                        ->send();
                }
            }else{
                if(GamesKey::create($this->data)) {
                    Notification::make()
                        ->title('Chaves Criadas')
                        ->body('Suas chaves foram criadas com sucesso!')
                        ->success()
                        ->send();
                }
            }


        } catch (Halt $exception) {
            Notification::make()
                ->title('Erro ao alterar dados!')
                ->body('Erro ao alterar dados!')
                ->danger()
                ->send();
        }
    }
}
