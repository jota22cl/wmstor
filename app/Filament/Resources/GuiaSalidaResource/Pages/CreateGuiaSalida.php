<?php

namespace App\Filament\Resources\GuiaSalidaResource\Pages;

use App\Filament\Resources\GuiaSalidaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use App\Models\Bodega;
use App\Models\Ccosto;
use App\Models\Cliente;
use App\Models\Contrato;
use Filament\Forms\Components\TextInput;

class CreateGuiaSalida extends CreateRecord
{
    protected static string $resource = GuiaSalidaResource::class;
    public $guiadetalles = [];
    protected static bool $canCreateAnother = false;

    protected function getContratoDetails()
    {
        // Busca el contrato usando el ID de la sesión
        $contrato = Contrato::with(['ccosto', 'cliente', 'bodega'])->find(session('vssContratoId'));
        if ($contrato) {
            return [
                'ccosto' => $contrato->ccosto->codigo,
                'cliente' => $contrato->cliente->nombre,
                'bodega' => $contrato->bodega->codigo,
            ];
        }
        return null;
    }

    public function getTitle(): string
    {
        $contratoDetails = $this->getContratoDetails();
        if ($contratoDetails) {
            $ccosto = $contratoDetails['ccosto'];
            $cliente = $contratoDetails['cliente'];
            $bodega = $contratoDetails['bodega'];
            // Construir el título con salto de línea
            return "Guía de Salida: [{$ccosto}] / [{$bodega}] / {$cliente}";
        }
        //redirect()->route('filament.admin.pages.custom-producto');   // esta line no me funciono
        return "Debe ir a 'Selección Cliente'.";
    }
    
    protected function beforeCreate() //: void
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Mutar datos antes de crear el registro
        //dd('data',$data);
        return $data;
    }

}
