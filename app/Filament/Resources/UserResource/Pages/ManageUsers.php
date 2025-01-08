<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'Usuarios';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (!session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nuevo Usuario')
                ->closeModalByClickingAway(false),
        ];
    }
}
