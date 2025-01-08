<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use Filament\Actions;
use App\Models\Bodega;
use App\Models\Ccosto;
use App\Models\Cliente;
use App\Models\Contrato;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;

use App\Filament\Resources\ProductoResource;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Contracts\View\View; // Importa la clase correcta de View

class ListProductos extends ListRecords
{
    protected static string $resource = ProductoResource::class;
    protected static ?string $title = 'El titulo';
    
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
            //return "[{$ccosto}] / [{$bodega}] / {$cliente}";
            return "Productos: [{$ccosto}] / [{$bodega}] / {$cliente}";
        }
        //redirect()->route('filament.admin.pages.custom-producto');   // esta line no me funciono
        //return "Debe ir a 'Selección Cliente'.";
        return "Primero debe 'Seleccionar Cliente'.";
    }

    protected function getHeaderActions(): array
    {
        if (session()->has('vssFolio')) {session()->forget('vssFolio');}
        if (session('vssContratoId')) {
            return [
                \EightyNine\ExcelImport\ExcelImportAction::make()
                    ->label("Carga Masiva")
                    ->color("primary")
                    ->uploadField(
                        fn ($upload) => $upload->label("Planilla Excel a cargar")
                    )
                    ->validateUsing([
                        'empresa_id' => 'required',
                        'contrato_id' => 'required',
                        'codigo' => 'required|max:15',
                        'descripcion' => 'required|max:60',
                        'unimed_ingreso_id' => 'required',
                        'unimed_salida_id' => 'required',
                        'factor_conversion' => 'required',
                        'codbarra_cliente' => 'max:30',
                        'codbarra_bodega' => 'max:30',
                        'codbarra_ean13' => 'max:13',
                        'codbarra_dun14' => 'max:14',
                        'lote' => 'max:30',
                        'inventariable' => 'boolean',
                        'vigente' => 'boolean',
                    ]),
                Actions\CreateAction::make(),
            ];
        }
        return [];
    }
    
    public function render(): View
    {
        $view = parent::render();

        // Aquí puedes personalizar más el título o cualquier otro componente si lo deseas
        //dd($view);

        return $view;
    }
}
