<?php

namespace App\Filament\Resources\ServicioResource\Pages;

use App\Filament\Resources\ServicioResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageServicios extends ManageRecords
{
    protected static string $resource = ServicioResource::class;
    protected static ?string $title = 'Servicios';
    
    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
            ->label('Nuevo Servicio')
            ->closeModalByClickingAway(false),
    ];
    }
}
