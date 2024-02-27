<?php

namespace App\Filament\Resources\ComunaResource\Pages;

use App\Filament\Resources\ComunaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageComunas extends ManageRecords
{
    protected static string $resource = ComunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nueva Ciudad')
                ->closeModalByClickingAway(false),
        ];
    }
}
