<?php

namespace App\Filament\Resources\GcomunResource\Pages;

use App\Filament\Resources\GcomunResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGcomuns extends ManageRecords
{
    protected static string $resource = GcomunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nuevo G.Común')
                ->closeModalByClickingAway(false),
        ];
    }
}
