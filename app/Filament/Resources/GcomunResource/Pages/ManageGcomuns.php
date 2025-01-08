<?php

namespace App\Filament\Resources\GcomunResource\Pages;

use App\Filament\Resources\GcomunResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGcomuns extends ManageRecords
{
    protected static string $resource = GcomunResource::class;
    protected static ?string $title = 'Gastos Comunes';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nuevo G.Común')
                ->closeModalByClickingAway(false),
        ];
    }
}
