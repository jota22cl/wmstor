<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use App\Models\Ccosto;
use App\Models\Ccosto_user;
use App\Models\Cliente;
use App\Models\Contrato;
//use App\Models\Producto;

//use Filament\Forms\Components\Buttons;

class CustomProducto extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $ccosto_id;
    public $cliente_id;
    public $bodega_id;
    public $contrato_id;
    public $contrato; // Nuevo campo para almacenar el contrato_id
    public $readOnlyMode = false; // Variable para controlar el modo de solo lectura
    public $showProductForm = false; // Variable para mostrar el CRUD de productos
    //public $productos = [];

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';
    protected static string $view = 'filament.pages.custom-producto';

    //protected static ?string $navigationLabel = 'Selección cliente';
    protected static ?string $navigationLabel = 'Seleccionar cliente';
    //protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Gestión Bodega';
    protected static ?string $title = 'Seleccione cliente a gestionar';
    protected static ?int $navigationSort = 1;



    // Método para manejar el envío del formulario
    public function submit()
    {
        //$this->contrato = $this->bodega_id; // Asigna el id de bodega al contrato
        $this->contrato = $this->contrato_id; // Asigna el id de bodega al contrato
        //dd("aqui",$this->contrato_id, $this->bodega_id);
        if (!$this->contrato) {
            return; // Si no hay contrato seleccionado, no hacer nada
        }
        // Guarda el contrato en la sesión
        session()->put('vssContratoId', $this->contrato);
        //dd("Ingreso de Productos.  Contrato:", $this->contrato);
        // Redirige al ProductoResource
        return redirect()->route('filament.admin.resources.productos.index');
    }
    
    //  filament.admin.pages.custom-producto
    
    
    public function goToGuiaIngreso()
    {
        //$this->contrato = $this->bodega_id;
        //dd("aqui",$this->contrato_id);
        $this->contrato = $this->contrato_id;
        if (!$this->contrato) {
            return;
        }
        session()->put('vssContratoId', $this->contrato);
        // Redirige a la página de Guía de Entrada (reemplaza por el resource correcto)
        //dd("Guia de Ingreso.  Contrato:", $this->contrato);
        return redirect()->route('filament.admin.resources.guia-ingresos.index');
    }
    
    public function goToGuiaSalida()
    {
        //$this->contrato = $this->bodega_id;
        $this->contrato = $this->contrato_id;
        if (!$this->contrato) {
            return;
        }
        session()->put('vssContratoId', $this->contrato);
        // Redirige a la página de Guía de Salida (reemplaza por el resource correcto)
        //dd("Guia de Salida.  Contrato:", $this->contrato);
        return redirect()->route('filament.admin.resources.guia-salidas.index');
    }
    

    // Método que se ejecuta cuando la página se monta
    public function mount(): void
    {
        // Inicializa las variables predeterminadas en null
        $defaultCcostoId = null;
        $defaultClienteId = null;
        $defaultBodegaId = null;
        $defaultContratoId = null;
        $user = auth()->user();
        
        // Verifica si el contrato está en la sesión
        if (session('vssContratoId') > 0) {
            $contrato = Contrato::with(['ccosto', 'cliente', 'bodega'])->find(session('vssContratoId'));
            
            // Si el contrato existe, asigna los valores predeterminados
            if ($contrato) {
                $defaultCcostoId = $contrato->ccosto_id;
                $defaultClienteId = $contrato->cliente_id;
                $defaultBodegaId = $contrato->bodega_id;
                $defaultContratoId = $contrato->id;
                //dd($contrato);
                // Rellena los valores en el formulario
                $this->form->fill([
                    'ccosto_id' => $defaultCcostoId,
                    'cliente_id' => $defaultClienteId,
                    'bodega_id' => $defaultBodegaId,
                    'contrato_id' => $defaultContratoId,
                ]);
                //dd($defaultCcostoId, $defaultClienteId, $defaultBodegaId);
                //dd($this->contrato_id);
                $this->contrato_id = session('vssContratoId');
                //dd($this->contrato_id);
            }
        }

        $ccostoOptions = $user->ccostos()
            ->select('ccostos.id', 'ccostos.descripcion')
            ->where('ccostos.vigente', true)
            ->where('ccostos.inventario', true)
            ->where('ccostos.empresa_id', $user->empresa_id)
            ->orderBy('ccostos.descripcion')
            ->pluck('ccostos.id');
        // Si hay opciones disponibles, selecciona la primera
        if ($ccostoOptions->isNotEmpty()) {
            $this->ccosto_id = $ccostoOptions->first();
        }

    }

protected function getFormSchema(): array
{
    return [
        Forms\Components\Card::make()->columns(12)
        ->schema([
            Forms\Components\Select::make('ccosto_id')
                ->label('Centro de Costo')
                ->columnSpan(3)
                ->options(function () {
                    $user = auth()->user();
                    return $user->ccostos()
                        ->select('ccostos.id', 'ccostos.descripcion')
                        ->where('ccostos.vigente', true)
                        ->where('ccostos.inventario', true)
                        ->where('ccostos.empresa_id', $user->empresa_id)
                        ->orderBy('ccostos.descripcion')
                        ->pluck('ccostos.descripcion', 'ccostos.id')
                        ->toArray();
                })
                ->required()
                ->reactive()
                ->disabled(fn () => $this->readOnlyMode)
                ->afterStateUpdated(fn (callable $set) => $set('cliente_id', null)),

            Forms\Components\Select::make('cliente_id')
                ->label('Cliente')
                ->columnSpan(7)
                ->options(function (callable $get) {
                    $ccostoId = $get('ccosto_id');
                    if ($ccostoId) {
                        return Cliente::whereHas('contratos', function ($query) use ($ccostoId) {
                                $query->where('empresa_id', auth()->user()->empresa_id)
                                ->where('ccosto_id', $ccostoId)
                                ->where('vigente', 1);
                            })
                            ->pluck('nombre', 'id');
                    }
                    return [];
                })
                //->searchable()
                ->required()
                ->reactive()
                ->disabled(fn () => !$this->ccosto_id || $this->readOnlyMode)
                ->afterStateUpdated(fn (callable $set) => $set('bodega_id', null)),

            Forms\Components\Select::make('bodega_id')
                ->label('Bodega')
                ->columnSpan(2)
                ->options(function (callable $get) {
                    $clienteId = $get('cliente_id');
                    if ($clienteId) {
                        return Contrato::where('empresa_id', auth()->user()->empresa_id)
                            ->where('cliente_id', $clienteId)
                            ->where('vigente', 1)
                            ->with('bodega')
                            ->get()
                            ->mapWithKeys(function ($contrato) {
                                return [$contrato->bodega->id => $contrato->bodega->codigo];
                            });
                    }
                    return [];
                })
                //->searchable()
                ->required()
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state, callable $get) {
                    if ($state) {
                        $ccostoId = $get('ccosto_id');
                        $clienteId = $get('cliente_id');
                        $contrato = Contrato::where('empresa_id', auth()->user()->empresa_id)
                            ->where('ccosto_id', $ccostoId)  // Filtro por Centro de Costo
                            ->where('cliente_id', $clienteId)  // Filtro por Cliente
                            ->where('bodega_id', $state)  // Filtro por Bodega
                            ->where('vigente', 1)  // Filtro por vigencia
                            ->first();
                        if ($contrato) {
                            $set('contrato_id', $contrato->id);
                            $set('bodega_id', $contrato->bodega->id);
                        }
                    }
                })
                ->disabled(fn () => !$this->cliente_id || $this->readOnlyMode),
            



        ]),
    ];
}



}
