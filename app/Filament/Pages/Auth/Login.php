<?php

namespace App\Filament\Pages\Auth;

use App\Models\Empresa;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseAuth;
 
class Login extends BaseAuth
{

    
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
