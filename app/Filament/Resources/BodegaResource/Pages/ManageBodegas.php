<?php

namespace App\Filament\Resources\BodegaResource\Pages;

use Filament\Actions;
use App\Filament\Resources\BodegaResource;
use Filament\Resources\Pages\ManageRecords;
//use App\Filament\Resources\BodegaResource\Widgets\BodegaChart;
use App\Filament\Resources\BodegaResource\Widgets\BodegaStatsOverview;

class ManageBodegas extends ManageRecords
{
    protected static string $resource = BodegaResource::class;
    protected static ?string $title = 'Bodegas';

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make()
                ->label('Nueva Bodega')
                ->closeModalByClickingAway(false),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BodegaStatsOverview::class,
            //BodegaChart::class,
        ];
    }

}
