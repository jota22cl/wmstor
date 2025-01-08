<?php

namespace App\Filament\Resources\ComunaResource\Pages;

use App\Filament\Resources\ComunaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageComunas extends ManageRecords
{
    protected static string $resource = ComunaResource::class;
    protected static ?string $title = 'Comunas';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nueva Comuna')
                ->closeModalByClickingAway(false),
        ];
    }
}
