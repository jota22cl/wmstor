<?php

namespace App\Filament\Resources\GadminResource\Pages;

use App\Filament\Resources\GadminResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGadmins extends ManageRecords
{
    protected static string $resource = GadminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nuevo G.Admin.')
                ->closeModalByClickingAway(false),
        ];
    }
}
