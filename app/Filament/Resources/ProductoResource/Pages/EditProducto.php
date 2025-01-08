<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use App\Models\Bodega;
use App\Models\Ccosto;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Productoperiodo;
use Filament\Forms\Components\TextInput;

class EditProducto extends EditRecord
{
    protected static string $resource = ProductoResource::class;

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
            return "[{$ccosto}] / [{$bodega}] / {$cliente}";
        }
        //redirect()->route('filament.admin.pages.custom-producto');   // esta line no me funciono
        return "Debe ir a 'Selección Cliente'.";
    }
    
    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
        ];
    }


    protected function afterSave(): void
    {
        Productoperiodo::firstOrCreate([
            'producto_id' => $this->record->id, // ID del producto recién creado o actualizado
        ], [
            'periodo' => auth()->user()->empresa->periodo,
//            'saldo_ini' => 0,                 // Valor inicial
//            'entradas' => 0,                  // Entradas iniciales
//            'salidas' => 0,                   // Salidas iniciales
        ]);
    }


    protected function getRedirectUrl(): string 
    {
        return $this->getResource()::getUrl('index');
    }
}
