<?php

namespace App\Filament\Resources\PseguroResource\Pages;

use App\Filament\Resources\PseguroResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePseguros extends ManageRecords
{
    protected static string $resource = PseguroResource::class;
    protected static ?string $title = 'Prima de Seguros';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nueva Prima Seguro')
                ->closeModalByClickingAway(false),
        ];
    }
}
