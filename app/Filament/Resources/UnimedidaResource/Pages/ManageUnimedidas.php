<?php

namespace App\Filament\Resources\UnimedidaResource\Pages;

use App\Filament\Resources\UnimedidaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUnimedidas extends ManageRecords
{
    protected static string $resource = UnimedidaResource::class;
    protected static ?string $title = 'Unidades de Medidas';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nueva Unidad de Medida')
                ->closeModalByClickingAway(false),
        ];
    }
}
