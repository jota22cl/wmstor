<?php

namespace App\Filament\Resources\BodegaResource\Widgets;

use App\Models\Bodega;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BodegaStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        //$mt2Total     = Bodega::all()->where('vigente',true)->sum('mt2');
        $mt2Ocupado   = Bodega::all()->where('vigente',true)->where('ocupada',true)->sum('mt2');
        $mt2SinOcupar = Bodega::all()->where('vigente',true)->where('ocupada',false)->sum('mt2');
        $mt2Total = $mt2Ocupado + $mt2SinOcupar;
        $mt2OcupadoPorcentaje = 0;
        if ($mt2Total > 0)
        {
            $mt2OcupadoPorcentaje = number_format(($mt2Ocupado / $mt2Total * 100), 0);
        }
        //endif
        //dd($mt2Total,$mt2Ocupado,$mt2SinOcupar);
        return [
            Card::make('Total bodegas', Bodega::all()->where('vigente',true)->count()),
            Card::make('Bodegas ocupadas', Bodega::where('ocupada',true)->where('vigente',true)->count()),
            Card::make('% Ocupado', $mt2OcupadoPorcentaje ),
            Card::make('Mt2 ocupados', $mt2Ocupado),
            Card::make('Mt2 sin ocupar', $mt2SinOcupar),
            Card::make('Mt2 TOTALES', $mt2Total),
            //Card::make('% Ocupado', ($mt2Ocupado / $mt2Total * 100)->decimalPlaces(2) ),
            //Card::make('% Sin ocupar', $mt2SinOcupar / $mt2Total * 100),
            //Card::make('Med.Confirmadas', Bodega::where('medidasok',true)->count()),
        ];
    }
}
