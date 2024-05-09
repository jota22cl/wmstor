<?php

namespace App\Filament\Resources\ClienteResource\Pages;

use App\Filament\Resources\ClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageClientes extends ManageRecords
{
    protected static string $resource = ClienteResource::class;
    protected static ?string $title = 'Clientes';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Nuevo Cliente')
            ->closeModalByClickingAway(false),
    ];
    }
}
