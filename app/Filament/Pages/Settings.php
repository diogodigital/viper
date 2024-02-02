<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\Actions\Action;


class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?string $navigationLabel = 'Configurações';

    protected static ?string $modelLabel = 'Configurações';

    protected static ?string $title = 'Configurações';

    protected static ?string $slug = 'configuracoes';

    public ?array $data = [];
    public Setting $setting;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->setting = Setting::first();
        $this->form->fill($this->setting->toArray());
    }

    /**
     * @param Form $form
     * @return Form
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detalhes do Site')
                    ->schema([
                        TextInput::make('software_name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(191),
                        TextInput::make('software_description')
                            ->label('Descrição')
                            ->maxLength(191),
                    ])->columns(2),
                Section::make('Logos')
                    ->schema([
                        FileUpload::make('software_favicon')
                            ->label('Favicon')
                            ->placeholder('Carregue um favicon')
                            ->image(),
                        FileUpload::make('software_logo_white')
                            ->label('Logo Branca')
                            ->placeholder('Carregue uma logo branca')
                            ->image(),
                        FileUpload::make('software_logo_black')
                            ->label('Logo Escura')
                            ->placeholder('Carregue uma logo escura')
                            ->image(),
                    ])->columns(3),
                Section::make('Depositos e Saques')
                    ->schema([
                        TextInput::make('min_deposit')
                            ->label('Min Deposito')
                            ->numeric()
                            ->maxLength(191),
                        TextInput::make('max_deposit')
                            ->label('Max Deposito')
                            ->numeric()
                            ->maxLength(191),
                        TextInput::make('min_withdrawal')
                            ->label('Min Saque')
                            ->numeric()
                            ->maxLength(191),
                        TextInput::make('max_withdrawal')
                            ->label('Max Saque')
                            ->numeric()
                            ->maxLength(191),
                    ])->columns(4),
                Section::make('Taxas')
                    ->description('Configurações de Ganhos da Plataforma')
                    ->schema([
                        Select::make('active_gateway')->options([
                            'bspay' => 'Bspay',
                            'suitpay' => 'Suitpay',
                            'sqala' => 'Sqala',
                        ]),
                        TextInput::make('revshare_percentage')
                            ->label('RevShare (%)')
                            ->numeric()
                            ->suffix('%')
                            ->maxLength(191),
                        TextInput::make('ngr_percent')
                            ->label('NGR (%)')
                            ->numeric()
                            ->suffix('%')
                            ->maxLength(191),
                    ])->columns(3),
                Section::make('Dados Gerais')
                    ->schema([
                        TextInput::make('initial_bonus')
                            ->label('Bônus Inicial (%)')
                            ->numeric()
                            ->suffix('%')
                            ->maxLength(191),
                        TextInput::make('currency_code')
                            ->label('Moeda')
                            ->maxLength(191),
                        Select::make('decimal_format')->options([
                            'dot' => 'Dot',
                        ]),
                        Select::make('currency_position')->options([
                            'left' => 'Left',
                            'right' => 'Right',
                        ]),
                    ])->columns(4),

                Section::make('Redes Sociais')
                    ->description('Digite a URL completa das redes social abaixo')
                    ->schema([
                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->placeholder('Digite a URL do Instagram')
                            ->maxLength(191),
                        TextInput::make('discord')
                            ->placeholder('Digite a URL do Discord')
                            ->label('Discord')
                            ->maxLength(191),
                        TextInput::make('telegram')
                            ->placeholder('Digite a URL do Telegram')
                            ->label('Telegram')
                            ->maxLength(191),
                        TextInput::make('twitter')
                            ->placeholder('Digite a URL do Twitter')
                            ->label('Twitter')
                            ->maxLength(191),
                        TextInput::make('tiktok')
                            ->placeholder('Digite a URL do Tiktok')
                            ->label('Tiktok')
                            ->maxLength(191),
                        TextInput::make('whatsapp')
                            ->placeholder('Digite a URL do Whatsapp')
                            ->label('Whatsapp')
                            ->maxLength(191),
                    ])->columns(2),
            ])
            ->statePath('data');
    }


    /**
     * @param array $data
     * @return array
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {

        return $data;
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('Submit'))
                ->action(fn () => $this->submit())
                ->submit('submit')
            //->url(route('filament.admin.pages.dashboard'))
            ,
        ];
    }

    /**
     * @param $array
     * @return mixed|void
     */
    private function uploadFile($array)
    {
        if(!empty($array) && is_array($array) || !empty($array) && is_object($array)) {
            foreach ($array as $k => $temporaryFile) {
                if ($temporaryFile instanceof TemporaryUploadedFile) {
                    $path = \Helper::upload($temporaryFile);
                    if($path) {
                        return $path['path'];
                    }
                }else{
                    return $temporaryFile;
                }
            }
        }
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

            $setting = Setting::first();
            if(!empty($setting)) {

                $favicon   = $this->data['software_favicon'];
                $logoWhite = $this->data['software_logo_white'];
                $logoBlack = $this->data['software_logo_black'];

                if (is_array($favicon) || is_object($favicon)) {
                    if(!empty($favicon)) {
                        $this->data['software_favicon'] = $this->uploadFile($favicon);
                    }
                }

                if (is_array($logoWhite) || is_object($logoWhite)) {
                    if(!empty($logoWhite)) {
                        $this->data['software_logo_white'] = $this->uploadFile($logoWhite);
                    }
                }

                if (is_array($logoBlack) || is_object($logoBlack)) {
                    if(!empty($logoBlack)) {
                        $this->data['software_logo_black'] = $this->uploadFile($logoBlack);
                    }
                }

                if(!empty($this->data['software_smtp_type'])) {
                    $envs = DotenvEditor::load(base_path('.env'));

                    $envs->setKeys([
                        'MAIL_MAILER' => $this->data['software_smtp_type'],
                        'MAIL_HOST' => $this->data['software_smtp_mail_host'],
                        'MAIL_PORT' => $this->data['software_smtp_mail_port'],
                        'MAIL_USERNAME' => $this->data['software_smtp_mail_username'],
                        'MAIL_PASSWORD' => $this->data['software_smtp_mail_password'],
                        'MAIL_ENCRYPTION' => $this->data['software_smtp_mail_encryption'],
                        'MAIL_FROM_ADDRESS' => $this->data['software_smtp_mail_from_address'],
                        'MAIL_FROM_NAME' => $this->data['software_smtp_mail_from_name'],
                    ]);

                    $envs->save();
                }

                if($setting->update($this->data)) {

                    Cache::put('setting', $setting);

                    Notification::make()
                        ->title('Dados alterados')
                        ->body('Dados alterados com sucesso!')
                        ->success()
                        ->send();

                    redirect(route('filament.admin.pages.dashboard'));

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
