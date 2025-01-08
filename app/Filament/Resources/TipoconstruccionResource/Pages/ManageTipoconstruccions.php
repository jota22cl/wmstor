<?php

namespace App\Filament\Resources\TipoconstruccionResource\Pages;

use App\Filament\Resources\TipoconstruccionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoconstruccions extends ManageRecords
{
    protected static string $resource = TipoconstruccionResource::class;
    protected static ?string $title = 'Tipos de Construcción';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nuevo Tipo Construcción')
                ->closeModalByClickingAway(false),
        ];
    }
}
