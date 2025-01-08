<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\Guia;
use Filament\Tables;

use App\Models\Operario;
use App\Models\Producto;
use App\Models\Unimedida;
use App\Models\Guiadetalle;
use App\Models\Contratoautretiro;
use App\Models\Contratoguiamail;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;

use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GuiaIngresoResource\Pages;
use App\Filament\Resources\GuiaIngresoResource\RelationManagers;
//use Filament\Forms\Components\Repeater;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
//use Filament\Forms\Components\Tabs;


class GuiaIngresoResource extends Resource
{
    protected static ?string $model = Guia::class;

    //protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square';
    //protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square-stack';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';
    //protected static ?string $navigationIcon = 'heroicon-o-arrow-right-end-on-rectangle';
    protected static ?string $navigationLabel = 'Guia de Ingreso';
    protected static ?string $navigationGroup = 'Gestión Bodega';
    protected static ?string $title = 'Guia de Ingreso';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        $isCreating = request()->routeIs('filament.admin.resources.guia-ingresos.create');
        //$folio = $isCreating ? self::generateFolio() : null;
        $folio = $isCreating ? self::generateFolio() : $form->getRecord()?->numeroGuia;
        if (!session()->has('vssFolio')) { session()->put('vssFolio', $folio); } // si no existe var de sesion, la crea
        $periodo = auth()->user()->empresa->periodo;
        $lafechaini = Carbon::create(substr($periodo, 0, 4), substr($periodo, 4, 2), 1)->format('Y-m-d');
        //$lafechaini = $lafechaini->startOfMonth()->format('Y-m-d');
        //dd($lafechaini);
        //$lafechafin = Carbon::create(substr($periodo, 0, 4), substr($periodo, 4, 2), 1)->endOfMonth()->format('Y-m-d');
        $lafechafin = date("Y-m-d",strtotime($lafechaini."+ 1 month"));

        //dd('aqui', fn ($record) => $record, $record );
        //dd('vamos a ver que trae', $record->producto);

        //dd($lafechaini, $lafechafin);
        //dd($form, $form->getRecord()->numeroGuia,$form->getRecord()->guia);

        return $form
        ->schema([
            Section::make()
            ->schema([
    
                Wizard::make([
                    Wizard\Step::make('Encabezado')
                        //->description('Guia Ingreso: '.$folio)
                        ->description('Guía Ingreso: ' . session('vssFolio'))
                        //->description(fn() => 'Guía Ingreso: ' . ($form->getState()['numeroGuia'] ?? $folio))
                        ->icon('heroicon-o-newspaper')
                        ->schema([
                            Hidden::make('empresa_id')->default(auth()->user()->empresa_id), // Llave empresa
                            Hidden::make('contrato_id')->default(session('vssContratoId')), // Llave contrato
                            Hidden::make('guia')->default('i'), //'i'=Guia de INGRESO
                            Hidden::make('numeroGuia')->default($folio), //numero de la Guia
                            Hidden::make('user_id')->default(auth()->user()->id), // Usuario logueado
                            //Hidden::make('fechaDigitacion')->default(Carbon::now()->format('d-m-Y H:i:s')), // Fecha y Hora (dd-mm-aaaa hh:mm:ss)
                            Hidden::make('fechaDigitacion')->default(now()), // Fecha y Hora (dd-mm-aaaa hh:mm:ss)
                            Hidden::make('periodo')->default(auth()->user()->empresa->periodo), // Periodo actual

                            Placeholder::make('valper1')
                                ->label('Ingreso #')
                                ->content(session('vssFolio'))
                                ->extraAttributes(['class' => 'bg-yellow-100 text-blue-600 font-bold text-2xl p-2 rounded'])
                                ->columnSpan(2),
//                            TextInput::make('numeroGuia')
//                                ->label('Ingreso #')
//                                ->required()
//                                ->default($folio)
//                                //->disabled(true)
//                                ->columnSpan(2),
                            DatePicker::make('fechaGuia')
                                ->default(now())
                                //->autofocus()
                                ->required()
                                ->native(false)
                                ->weekStartsOnMonday()
                                ->after($lafechaini)
                                ->before($lafechafin)
                                ->columnSpan(3)
                                ,
                            //->default(Carbon::now()->format('d-m-Y'))
                            Select::make('tipoGuia')
                                ->label('Tipo Guía')
                                ->options([
                                    'n' => 'Guia Normal',
                                    'ab' => 'Ajuste Bodega',
                                    'ac' => 'Ajuste Cliente',
                                ])
                                ->default('n')
                                ->required()
                                ->columnSpan(3),
                            Toggle::make('correoCliente')
                                ->label('Guía solicitada por correo')
                                ->onColor('success')
                                ->offColor('danger')
                                ->columnSpan(4)
                                ->inline(),

                            TextInput::make('empresatransporte')
                                ->label('Transportista')
                                ->autofocus()
                                ->disableAutocomplete()
                                //->required()
                                ->maxLength(30)
                                ->columnSpan(3),
                            TextInput::make('patente')
                                ->label('Patente')
                                ->autofocus()
                                ->disableAutocomplete()
                                //->required()
                                ->columnSpan(2)
                                ->maxLength(6),
                            TextInput::make('choferRut')
                                ->label('Rut Chofer')
                                ->autofocus()
                                ->disableAutocomplete()
                                ->mask('99.999.999-*')
                                //->required()
                                ->columnSpan(2)
                                ->minLength(10)
                                ->maxLength(15),
                            TextInput::make('choferNombre')
                                ->label('Nombre Chofer')
                                ->autofocus()
                                ->disableAutocomplete()
                                //->required()
                                ->columnSpan(5)
                                ->maxLength(50),

                            TextInput::make('guiaCliente')
                                //->required()
                                ->label('Guía Cliente')
                                ->integer()
                                ->columnSpan(2)
                                ->default(0),
                            TextInput::make('factCliente')
                                //->required()
                                ->label('Factura Cliente')
                                ->integer()
                                ->columnSpan(2)
                                ->default(0),
                            Select::make('contratoautretiro_id')
                                ->label('Autorización Cliente')
                                ->columnSpan(4)
                                ->required()
                                ->options(Contratoautretiro::where('contrato_id', session('vssContratoId', 0))->orderBy('nombre')->pluck('nombre', 'id'))
                                //->options(function () {
                                //    $contratoId = session('vssContratoId');
                                //    if ($contratoId) {
                                //        return Contratoautretiro::where('contrato_id', $contratoId)
                                //            ->orderBy('nombre')
                                //            ->pluck('nombre', 'id');
                                //    }
                                //    return [];
                                //})

                        ])->columns(12),

                    Wizard\Step::make('Detalle')
                        ->icon('heroicon-m-bars-4')
                        ->schema([
                            Placeholder::make('valper1')
                                ->label('Ingreso #')
                                ->content(session('vssFolio'))
                                ->extraAttributes(['class' => 'bg-yellow-100 text-blue-600 font-bold text-2xl p-2 rounded'])
                                ->columnSpan(2),

                            TableRepeater::make('guiadetalles')
                            //Repeater::make('guiadetalles')
                                ->relationship('guiadetalles')
                                ->label('Detalle de productos')
                                ->statePath('guiadetalles')
                                ->columns(12)
                                //->reorderable()
                                //->cloneable()
                                //->collapsible()
                                ->minItems(1)
                                ->maxItems(40)
                                ->schema([
                                    //Grid::make(12) // Configura el grid con 12 columnas
                                    //->schema([
                                        Hidden::make('empresa_id')->default(auth()->user()->empresa_id), // Llave empresa
                                        Hidden::make('contrato_id')->default(session('vssContratoId')), // Llave contrato
                                        Hidden::make('periodo')->default(auth()->user()->empresa->periodo), // Periodo actual
                                        Hidden::make('factor')->default(1), // Factor ( 1 / -1 )
                                        // Campo para seleccionar por código
                                        Select::make('producto_codigo')
                                            ->label('Código')
                                            ->searchable()
                                            ->required()
                                            ->options(fn () => Producto::where('empresa_id', auth()->user()->empresa_id)
                                                ->where('contrato_id', session('vssContratoId', 0))
                                                ->where('vigente', true)
                                                ->where('inventariable', true)
                                                ->pluck('codigo', 'id'))
                                            ->reactive()
                                            ->afterStateUpdated(function (callable $set, $state) {
                                                $producto = Producto::find($state);
                                                if ($producto) {
                                                    $set('producto_descripcion', $producto->descripcion);
                                                    $set('producto_id', $producto->id);
                                                    $unimedIngreso = Unimedida::find($producto->unimed_ingreso_id);
                                                    $set('producto_unimed', $unimedIngreso?->codigo ?? 'N/A'); // Asigna el código o 'N/A' si no existe
                                                }
                                            })
                                            ->columnSpan(3),
                                        // Campo para seleccionar por descripción
                                        Select::make('producto_descripcion')
                                            ->label('Descripción')
                                            ->searchable()
                                            ->required()
                                            ->options(fn () => Producto::where('empresa_id', auth()->user()->empresa_id)
                                                ->where('contrato_id', session('vssContratoId', 0))
                                                ->where('vigente', true)
                                                ->where('inventariable', true)
                                                ->pluck('descripcion', 'id'))
                                            ->reactive()
                                            ->afterStateUpdated(function (callable $set, $state) {
                                                $producto = Producto::find($state);
                                                if ($producto) {
                                                    $set('producto_codigo', $producto->codigo);
                                                    $set('producto_id', $producto->id);
                                                    $unimedIngreso = Unimedida::find($producto->unimed_ingreso_id);
                                                    $set('producto_unimed', $unimedIngreso?->codigo ?? 'N/A'); // Asigna el código o 'N/A' si no existe
                                                }
                                            })
                                            ->columnSpan(6),
                                        TextInput::make('producto_unimed')
                                            ->label('UM')
                                            ->disabled(true)
                                            ->columnSpan(1), // Ocupa 1 columna
                                        Hidden::make('producto_id')
                                            ->afterStateHydrated(function (callable $set, $state) {
                                                if ($state) {
                                                    // Busca el producto en la base de datos
                                                    $producto = Producto::find($state);
                                                    if ($producto) {
                                                        // Asigna los valores a los otros campos
                                                        $set('producto_codigo', $producto->codigo);
                                                        $set('producto_descripcion', $producto->descripcion);
                                                        $unimedIngreso = Unimedida::find($producto->unimed_ingreso_id);
                                                        $set('producto_unimed', $unimedIngreso?->codigo ?? 'N/A'); // Asigna el código o 'N/A' si no existe
                                                        }
                                                }
                                            }),
                                        
                                        TextInput::make('cantidad')
                                            ->label('Cantidad')
                                            ->required()
                                            ->numeric(8,2)
                                            ->minValue(1)
                                            //->default(0),
                                            ->default(fn ($record) => $record->cantidad ?? 0)
                                            ->columnSpan(2), // Ocupa 2 columnas
                                    //]), //del Shema despues del Grid
                                ]), //del Shema antes del Grid

                        ]),

                    //Wizard\Step::make('Emite Guía')
                    //    ->icon('heroicon-o-printer')
                    Wizard\Step::make('Observaciones')
                        ->icon('heroicon-o-document-check')
                        ->schema([
                            Placeholder::make('valper1')
                                ->label('Ingreso #')
                                ->content(session('vssFolio'))
                                ->extraAttributes(['class' => 'bg-yellow-100 text-blue-600 font-bold text-2xl p-2 rounded'])
                                ->columnSpan(2),
                            Select::make('operario_id')
                                ->label('Preparado por')
                                ->columnSpan(5)
                                ->required()
                                ->options(Operario::where('empresa_id', auth()->user()->empresa_id)->where('vigente','=',true)->orderBy('nombre')->pluck('nombre','id')),
                            Placeholder::make('valorPersonalizado2')
                                ->label('Digitado por')
                                ->content(auth()->user()->name)
                                ->columnSpan(5),

                            Textarea::make('observacion')
                                ->label('Observaciones')
                                ->columnSpan(12)
                                ->rows(6)
                                ->maxLength(1000),

                        ])->columns(12),
                ]) // esta linea cierra el Wizard principal
            ])
        ]); //->columns(12);
    }
    
    

    public static function generateFolio()
    {
        //dd(auth()->user()->empresa->folioGuiaIngreso);
        // Ejemplo básico de generación de folio: incrementar el último valor
        //$lastFolio = Programa::max('folio');
        $newFolio = auth()->user()->empresa->folioGuiaIngreso + 1;

        $empresa = auth()->user()->empresa;
        $empresa->folioGuiaIngreso = $newFolio;
        $empresa->save();


        return $newFolio;
    }


    public static function getEloquentQuery(): Builder
    {
        $customParam = session('vssContratoId');
        if ($customParam) {
            return static::getModel()::query()
                ->where('empresa_id', auth()->user()->empresa_id)
                ->where('guia', 'i')
                ->where('contrato_id', $customParam)
                ->orderBy('estado', 'asc')
                ->orderBy('numeroGuia', 'desc');
        }else{
            //redirect()->route('filament.admin.pages.custom-producto');
            return static::getModel()::query()
                ->where('empresa_id', 0)
                ->orderBy('estado', 'asc')
                ->orderBy('numeroGuia', 'desc');
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('numeroGuia', 'desc')
            ->columns([
                TextColumn::make('numeroGuia')
                    ->label('Nro.Guía')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fechaGuia')
                    ->label('Fecha')
                    ->date($format='D d F Y')
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('empresatransporte')
                    ->label('Emp.Transporte')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('patente')
                    ->label('Nro.Patente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    //->weight('bold')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'd' => 'Digitado',
                            'e' => 'Emitido',
                            default => $state, // Muestra el valor original si no coincide
                        };
                    })
                    ->color(function ($state) {
                        return match ($state) {
                            'd' => 'warning',
                            'e' => 'success',
                            default => 'gray',
                        };
                    })
                    ->extraAttributes(function ($state) {
                        return ['style' => 'font-weight: bold;']; // Aplica negrita al texto
                    }),


                // Columna con el enlace para emitir guía
                TextColumn::make('emiteNumeroGuia')
                    ->label('Acción')
                    ->getStateUsing(fn ($record) => 
                        $record->estado === 'd'
                            ? '<a href="' . route('guia-ingresos.GuiaIngreso', $record->id) . '" 
                                target="_blank" 
                                style="
                                    display: inline-flex; 
                                    align-items: center; 
                                    gap: 5px; 
                                    padding: 4px 10px; 
                                    color: #fff; 
                                    background-color: #007bff; 
                                    text-decoration: none; 
                                    border-radius: 10px; 
                                    font-weight: bold;
                                ">
                                Emite Guía
                            </a>'
                            : '<a href="' . route('guia-ingresos.GuiaIngreso', $record->id) . '" 
                                target="_blank" 
                                style="
                                    display: inline-flex; 
                                    align-items: center; 
                                    gap: 5px; 
                                    padding: 4px 10px; 
                                    color: #fff; 
                                    background-color: #28a745; 
                                    text-decoration: none; 
                                    border-radius: 10px; 
                                    font-weight: bold;
                                ">
                                Copia Guía
                            </a>'
                    )
                    ->alignCenter()
                    //->refreshTable()
                    ->html(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Grupo de acciones a la izquierda
                ActionGroup::make([
                    ViewAction::make()->label('Ver')->closeModalByClickingAway(false)->color('gray'),
                    EditAction::make()->label('Modificar')->closeModalByClickingAway(false)->color('info'),
                    // DeleteAction::make()->label('Borrar')->closeModalByClickingAway(false)->color('danger'),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ], position: ActionsPosition::BeforeColumns) // Posición de las acciones "Ver" y "Modificar" a la izquierda
            ->bulkActions([ /*
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]), */
            ])
            ->emptyStateActions([
                //Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuiaIngresos::route('/'),
            'create' => Pages\CreateGuiaIngreso::route('/create'),
            'edit' => Pages\EditGuiaIngreso::route('/{record}/edit'),
            'view' => Pages\ViewGuiaIngreso::route('/{record}'),
        ];
    }

}

