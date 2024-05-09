<?php

namespace App\Filament\Resources\LasmonedaResource\Pages;

use App\Filament\Resources\LasmonedaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLasmonedas extends ManageRecords
{
    protected static string $resource = LasmonedaResource::class;
    protected function getHeaderActions(): array
    { 
        return [
            Actions\CreateAction::make(),
        ]; 
    }
}
