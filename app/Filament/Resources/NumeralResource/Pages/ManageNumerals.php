<?php

namespace App\Filament\Resources\NumeralResource\Pages;

use App\Filament\Resources\NumeralResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageNumerals extends ManageRecords
{
    protected static string $resource = NumeralResource::class;
    protected static ?string $title = 'Grupo Numeral';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nuevo Grupo Numeral')
                ->closeModalByClickingAway(false),
        ];
    }
}
