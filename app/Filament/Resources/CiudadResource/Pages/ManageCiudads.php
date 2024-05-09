<?php

namespace App\Filament\Resources\CiudadResource\Pages;

use App\Filament\Resources\CiudadResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCiudads extends ManageRecords
{
    protected static string $resource = CiudadResource::class;
    protected static ?string $title = 'Ciudades';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nueva Ciudad')
                ->closeModalByClickingAway(false),
        ];
    }
}
