<?php

namespace App\Filament\Resources\GadminResource\Pages;

use App\Filament\Resources\GadminResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGadmins extends ManageRecords
{
    protected static string $resource = GadminResource::class;
    protected static ?string $title = 'Gastos de Administración';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nuevo G.Admin.')
                ->closeModalByClickingAway(false),
        ];
    }
}
