<?php

namespace App\Filament\Resources\VendedorResource\Pages;

use App\Filament\Resources\VendedorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVendedors extends ManageRecords
{
    protected static string $resource = VendedorResource::class;
    protected static ?string $title = 'Vendedores';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
            ->label('Nuevo Vendedor')
            ->closeModalByClickingAway(false),
        ];
    }
}
