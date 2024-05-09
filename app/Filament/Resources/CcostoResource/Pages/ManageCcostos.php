<?php

namespace App\Filament\Resources\CcostoResource\Pages;

use App\Filament\Resources\CcostoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCcostos extends ManageRecords
{
    protected static string $resource = CcostoResource::class;
    protected static ?string $title = 'Centro de Costos';
    //protected ?string $subheading = 'Custom Page Subheading';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nuevo C.Costo')
                ->closeModalByClickingAway(false),
        ];
    }
}
