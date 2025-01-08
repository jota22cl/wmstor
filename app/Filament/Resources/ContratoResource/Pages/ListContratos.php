<?php

namespace App\Filament\Resources\ContratoResource\Pages;

use Filament\Actions;
//use App\Models\Contrato;
//use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ContratoResource;
//use Filament\Pages\Concerns\ExposesTableToWidgets;
//use Filament\Support\Colors\Color;

class ListContratos extends ListRecords
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        session()->put('vssContratoId', 0);
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        return [
            Actions\CreateAction::make(),
        ];
    }

//    protected function getHeaderWidgets(): array
//    {
//        return ContratoResource::getWidgets();
//    }
//
//    // https://www.youtube.com/watch?v=ddvQa8zxKwI 
//    // Tablas con FilamentPHP: Añade estas badges a tus pestañas!
//    public function getTabs(): array
//    {
//        return [
//            null => Tab::make('All')->badge($this->contratosByStatus() ?? 0)->badgeColor(Color::Cyan)->label('TOTAL'),
//            'ADM' => Tab::make()->query(fn ($query) => $query->where('ccosto_id', 1))->badge($this->contratosByStatus(1) ?? 0)->badgeColor(Color::Cyan)->label('ADM'),
//            'LLM' => Tab::make()->query(fn ($query) => $query->where('ccosto_id', 2))->badge($this->contratosByStatus(2) ?? 0)->badgeColor(Color::Cyan)->label('LLM'),
//            'ISP' => Tab::make()->query(fn ($query) => $query->where('ccosto_id', 3))->badge($this->contratosByStatus(3) ?? 0)->badgeColor(Color::Cyan)->label('ISP'),
//            'FRIO' => Tab::make()->query(fn ($query) => $query->where('ccosto_id', 4))->badge($this->contratosByStatus(4) ?? 0)->badgeColor(Color::Cyan)->label('FRIO'),
//            'CONG' => Tab::make()->query(fn ($query) => $query->where('ccosto_id', 5))->badge($this->contratosByStatus(5) ?? 0)->badgeColor(Color::Cyan)->label('CONG'),
//        ];
//    }
//
//    private function contratosByStatus(string $status = null){
//        if(blank($status)){
//            return Contrato::count();
//        }
//        return Contrato::where('ccosto_id', $status)->count();
//    }
}
