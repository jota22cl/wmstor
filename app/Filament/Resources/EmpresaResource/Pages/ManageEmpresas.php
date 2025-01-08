<?php

namespace App\Filament\Resources\EmpresaResource\Pages;

use App\Filament\Resources\EmpresaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEmpresas extends ManageRecords
{
    protected static string $resource = EmpresaResource::class;
    protected static ?string $title = 'Empresas';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nueva Empresa')
                ->modalIcon('heroicon-o-plus')
                ->closeModalByClickingAway(false),
        ];
    }
}
