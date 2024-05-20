<?php

namespace App\Filament\Pages\Auth;

use App\Models\Empresa;
use Filament\Forms\Form;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseAuth;
use Filament\Http\Responses\Auth\LoginResponse;
 
class Login extends BaseAuth
{


/*    
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/login.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/login.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/login.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            throw ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

        session()->regenerate();
        //$_SESSION["empresa_id"]=15;
        //$_SESSION["empresa_name"]="Almacenes Generales de Deposito Storage S.A.";
        //$_SESSION["empresa_sigla"]="STORAGE";
        //dd($_SESSION["empresa_id"],$_SESSION["empresa_name"],$_SESSION["empresa_sigla"],session());
        return app(LoginResponse::class);
    }
*/


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmpresaFormComponent(),
                $this->getEmailFormComponent(), 
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getEmpresaFormComponent(): Component 
    {
        return Select::make('empresa_id')
            ->label('Empresa')
            //->required()
            ->autofocus()
            //->relationship('empresas', 'razonsocial')
            ->options(Empresa::where('vigente','=',true)->pluck('razonsocial','id'))
            ->preload()
            ;


    } 


    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'email' => $data['email'],
            'password' => $data['password'],
            'empresa_id' => $data['empresa_id'],
        ];
    }
    
}
