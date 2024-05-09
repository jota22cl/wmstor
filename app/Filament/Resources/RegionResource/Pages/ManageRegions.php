<?php

namespace App\Filament\Resources\RegionResource\Pages;

use App\Filament\Resources\RegionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRegions extends ManageRecords
{
    protected static string $resource = RegionResource::class;
    protected static ?string $title = 'Regiones';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nueva Región')
                ->closeModalByClickingAway(false),
        ];
    }
}
