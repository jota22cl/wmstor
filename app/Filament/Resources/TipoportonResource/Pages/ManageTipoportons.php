<?php

namespace App\Filament\Resources\TipoportonResource\Pages;

use App\Filament\Resources\TipoportonResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipoportons extends ManageRecords
{
    protected static string $resource = TipoportonResource::class;
    protected static ?string $title = 'Tipos de Porton';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nuevo Tipo Porton')
                ->closeModalByClickingAway(false),
        ];
    }
}
