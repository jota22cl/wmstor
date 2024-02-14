<?php

namespace App\Filament\Resources\CcostoResource\Pages;

use App\Filament\Resources\CcostoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCcostos extends ManageRecords
{
    protected static string $resource = CcostoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
