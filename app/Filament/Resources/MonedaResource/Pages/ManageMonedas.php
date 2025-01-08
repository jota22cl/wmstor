<?php

namespace App\Filament\Resources\MonedaResource\Pages;

use App\Filament\Resources\MonedaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMonedas extends ManageRecords
{
    protected static string $resource = MonedaResource::class;
    protected static ?string $title = 'Monedas';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nueva Moneda')
                ->closeModalByClickingAway(false),
        ];
    }
}
