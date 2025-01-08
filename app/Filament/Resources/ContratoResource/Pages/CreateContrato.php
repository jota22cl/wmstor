<?php

namespace App\Filament\Resources\ContratoResource\Pages;

use App\Filament\Resources\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContrato extends CreateRecord
{
    protected static string $resource = ContratoResource::class;
    protected static bool $canCreateAnother = false;

    protected function beforeCreate() //: void
    {
        return $this->getResource()::getUrl('index');
    }


    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }

}
