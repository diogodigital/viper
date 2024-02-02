<?php

namespace App\Filament\Pages;

use App\Models\Gateway;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class GatewayPage extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.gateway-page';

    protected static ?string $navigationLabel = 'Gateway de Pagamento';

    protected static ?string $title = 'Gateway de Pagamento';

    public ?array $data = [];
    public Gateway $setting;

    /**
     * @return void
     */
    public function mount(): void
    {
        $gateway = Gateway::first();
        if(!empty($gateway)) {
            $this->setting = $gateway;
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
                Section::make('Sqala')
                    ->description('Ajustes de credenciais para a Sqala')
                    ->schema([
                        TextInput::make('sqala_app_id')
                            ->label('Sqala App ID')
                            ->placeholder('Digite o app ID')
                            ->maxLength(191),
                        TextInput::make('sqala_app_secret')
                            ->label('Sqala App Secret')
                            ->placeholder('Digite o App Secret')
                            ->maxLength(191),
                        Textarea::make('sqala_access_token')
                            ->label('Sqala Access Token')
                            ->placeholder('Digite a Access Token')
                            ->maxLength(191)
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make('BsPay')
                    ->description('Ajustes de credenciais para a BsPay')
                    ->schema([
                        TextInput::make('bspay_uri')
                            ->label('BsPay URI')
                            ->placeholder('Digite a url da API')
                            ->maxLength(191)
                            ->default('https://api.bspay.co/v1/')
                            ->columnSpanFull(),
                        TextInput::make('bspay_cliente_id')
                            ->label('Client ID')
                            ->placeholder('Digite o client id')
                            ->maxLength(191)
                            ->columnSpanFull(),
                        TextInput::make('bspay_cliente_secret')
                            ->label('Client Secret')
                            ->placeholder('Digite a chave secreta')
                            ->maxLength(191)
                            ->columnSpanFull(),
                    ]),
                Section::make('Suitpay')
                    ->description('Ajustes de credenciais para a Suitpay')
                    ->schema([
                        TextInput::make('suitpay_uri')
                            ->label('Client URI')
                            ->placeholder('Digite a url da api')
                            ->maxLength(191)
                            ->columnSpanFull(),
                        TextInput::make('suitpay_cliente_id')
                            ->label('Client ID')
                            ->placeholder('Digite o client ID')
                            ->maxLength(191)
                            ->columnSpanFull(),
                        TextInput::make('suitpay_cliente_secret')
                            ->label('Client Secret')
                            ->placeholder('Digite o client secret')
                            ->maxLength(191)
                            ->columnSpanFull(),
                    ]),
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

            $setting = Gateway::first();
            if(!empty($setting)) {
                if($setting->update($this->data)) {
                    if(!empty($this->data['stripe_public_key'])) {
                        $envs = DotenvEditor::load(base_path('.env'));

                        $envs->setKeys([
                            'STRIPE_KEY' => $this->data['stripe_public_key'],
                            'STRIPE_SECRET' => $this->data['stripe_secret_key'],
                            'STRIPE_WEBHOOK_SECRET' => $this->data['stripe_webhook_key'],
                        ]);

                        $envs->save();
                    }

                    Notification::make()
                        ->title('Chaves Alteradas')
                        ->body('Suas chaves foram alteradas com sucesso!')
                        ->success()
                        ->send();
                }
            }else{
                if(Gateway::create($this->data)) {
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
