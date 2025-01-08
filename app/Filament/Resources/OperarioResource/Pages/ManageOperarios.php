<?php

namespace App\Filament\Resources\OperarioResource\Pages;

use App\Filament\Resources\OperarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOperarios extends ManageRecords
{
    protected static string $resource = OperarioResource::class;
    protected static ?string $title = 'Operarios';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
            ->label('Nuevo Operario')
            ->closeModalByClickingAway(false),
        ];
    }
}
