<?php

namespace App\Filament\Resources\PseguroResource\Pages;

use App\Filament\Resources\PseguroResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePseguros extends ManageRecords
{
    protected static string $resource = PseguroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nueva Prima Seguro')
                ->closeModalByClickingAway(false),
        ];
    }
}
