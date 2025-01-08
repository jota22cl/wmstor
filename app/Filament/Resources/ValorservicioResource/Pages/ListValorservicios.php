<?php

namespace App\Filament\Resources\ValorservicioResource\Pages;

use App\Filament\Resources\ValorservicioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListValorservicios extends ListRecords
{
    protected static string $resource = ValorservicioResource::class;

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make(),
        ];
    }
}
