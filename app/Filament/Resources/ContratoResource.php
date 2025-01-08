<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;

use App\Models\Bodega;
use App\Models\Ccosto;
use App\Models\Gadmin;
use App\Models\Gcomun;
use App\Models\Moneda;
use App\Models\Cliente;
use App\Models\Pseguro;
use App\Models\Contrato;
use App\Models\Servicio;
use App\Models\Vendedor;
//use App\Models\Contratoreplegal;
//use App\Models\Contratopagoproveedor;
//use App\Models\Contratodtemail;
//use App\Models\Contratocoordinador;
//use App\Models\Contratoautretiro;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
//use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
//use Filament\Forms\Components\RichEditor;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\SelectColumn;

use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Enums\ActionsPosition;


use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\ContratoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ContratoResource\RelationManagers;

class ContratoResource extends Resource
{
    protected static ?string $model = Contrato::class;

    protected static ?string $navigationGroup = 'Tablas Maestras';
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationLabel = 'Contratos';
    protected static ?int $navigationSort = 4;


    public static function form(Form $form): Form
    {
        //dd($form);
        return $form
        ->schema([
        //Forms\Components\Card::make()
        Section::make()
        ->schema([
            //Llave empresa
            Hidden::make('empresa_id')->default(auth()->user()->empresa_id),

            Tabs::make('Tabs')
            ->tabs([
            /******************************************************
             * TAB de identificacion del contrato
             *****************************************************/
            Tabs\Tab::make('Identificación')
                ->icon('heroicon-m-identification')
                ->schema([
                    Select::make('cliente_id')
                        ->label('Cliente')
                        ->columnSpan(12)
                        ->required()
                        ->disabled(fn ($livewire): bool => !($livewire instanceof CreateRecord)) // este dato lo pide cuendo se esta creando un registro
                        ->options(Cliente::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('nombre')->pluck('nombre','id'))
                        ->searchable(),
                    Select::make('ccosto_id')
                        ->label('C.Costo')
                        ->columnSpan(4)
                        ->required()
                        ->disabled(fn ($livewire): bool => !($livewire instanceof CreateRecord)) // este dato lo pide cuendo se esta creando un registro
                        ->options(Ccosto::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('descripcion')->pluck('descripcion','id'))
                        ->searchable(),
                    Select::make('bodega_id')
                        ->label('Bodega')
                        ->columnSpan(4)
                        ->required()
                        ->disabled(fn ($livewire): bool => !($livewire instanceof CreateRecord)) // este dato lo pide cuendo se esta creando un registro
                        ->options(Bodega::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('codigo')->pluck('codigo','id'))
                        ->searchable(),
                    TextInput::make('folioContrato')
                        ->label('Folio')
                        ->required()
                        ->disabled(fn ($livewire): bool => !($livewire instanceof CreateRecord)) // este dato lo pide cuendo se esta creando un registro
                        ->columnSpan(4)
                        //->numeric()
                        ->integer()
                        //->inputMode('decimal',2)
                        //->default(0)
                        ,
                    Select::make('vendedor_id')
                        ->label('Vendedor')
                        ->columnSpan(4)
                        ->required()
                        ->options(Vendedor::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('nombre')->pluck('nombre','id'))
                        ->searchable(),
                    DatePicker::make('fecha_ini')
                        ->label('Inicio Contrato')
                        ->required()
                        ->columnSpan(4)
                        ->native(false)
                        ->firstDayOfWeek(1)
                        ->suffixIcon('heroicon-m-calendar-days'),
                    DatePicker::make('fecha_fin')
                        ->label('Termino Contrato')
                        //->required()
                        ->columnSpan(4)
                        ->native(false)
                        ->firstDayOfWeek(1)
                        ->suffixIcon('heroicon-m-calendar-days'),

                    Select::make('tipoArriendo')
                        ->options([
                            'Mensual' => 'Mensual',
                            'por Mt2' => 'por Mt2',
                            'por Pallet' => 'por Pallet',
                        ])
                        ->columnSpan(3),
                    TextInput::make('valorArriendo')
                        //->required()
                        ->label('Mto.Arriendo')
                        ->numeric()
                        ->columnSpan(3)
                        ->default(0),
                    TextInput::make('montoMinimo')
                        //->required()
                        ->label('Minimo')
                        ->columnSpan(3)
                        ->numeric()
                        ->default(0),
                    Select::make('unimedMinimo')
                        ->label('Unidad Min.')
                        ->options([
                            'U.F.' => 'U.F.',
                            'MT2' => 'MT2',
                            'Pallet' => 'Pallet',
                        ])
                        ->columnSpan(3),




                    Select::make('gastosComunes_id')
                        ->label('Gastos Comunes')
                        ->columnSpan(6)
                        //->required()
                        ->options(Gcomun::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('descripcion')->pluck('descripcion','id'))
                        ->searchable(),
                    Select::make('gastosAdministracion_id')
                        ->label('Gastos Administracion')
                        ->columnSpan(6)
                        //->required()
                        ->options(Gadmin::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('descripcion')->pluck('descripcion','id'))
                        ->searchable(),

                    Select::make('primaSeguro_id')
                        ->label('Prima de Seguros')
                        ->columnSpan(4)
                        //->required()
                        ->options(Pseguro::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('descripcion')->pluck('descripcion','id'))
                        ->searchable(),
                    TextInput::make('montoAsegurado')
                        ->label('Monto asegurado')
                        //->visible(fn ($record) => $record->ccosto->garantia ?? false)  //va a pedir el dato solo con el campo en true
                        //->required()
                        ->minValue('0')
                        ->maxValue('999999999')
                        //->stripCharacters(',')
                        ->columnSpan(3)
                        ->integer(),
                    Select::make('monedaMontoAsegurado_id')
                        ->label('Moneda monto asegurado')
                        ->columnSpan(4)
                        //->required()
                        ->options(Moneda::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('codigo')->pluck('codigo','id'))
                        ->searchable(),

                    Select::make('estado')
                        ->options([
                            'elab' => 'En elaboración',
                            'docum' => 'Documentación pendiente',
                            'firma' => 'Firma pendiente',
                            'revision' => 'En revision',
                            'completo' => 'Finalizado/Completo',
                            'nulo' => 'Anulado',
                        ])
                        ->required()
                        ->searchable()
                        ->columnSpan(7),
                    TextInput::make('montoGarantia')
                        ->label('Monto a pagar por garantia')
                        ->visible(fn ($record) => $record->ccosto->garantia ?? false)  //va a pedir el dato solo con el campo en true
                        //->required()
                        ->minValue('0')
                        ->maxValue('99999999')
                        //->stripCharacters(',')
                        ->columnSpan(3)
                        ->integer(),
                    Textarea::make('observacion')
                        ->label('Observaciones')
                            ->columnSpan(12)
                            ->rows(5)
                            ->maxLength(1000),
                    //RichEditor::make('observacion')
                    //    ->label('Observaciones')
                    //    ->columnSpan(12)
                    //    ->toolbarButtons([
                    //        'blockquote',
                    //        'bold',
                    //        'bulletList',
                    //        'codeBlock',
                    //        'italic',
                    //        'orderedList',
                    //        'redo',
                    //        'strike',
                    //        'underline',
                    //        'undo',
                    //    ])
                    //    ->maxLength(1000),
                    Toggle::make('vigente')
                        ->label('Contrato Vigente/No vigente')
                        ->required()
                        ->columnSpan(3)
                        ->default(true)
                        ->onIcon('heroicon-o-check')
                        ->offIcon('heroicon-o-x-mark')
                        ->onColor('success')
                        ->offColor('danger'),
                ]), //->schema([     "del Tabs\Tab::make('Identificación')"



            /******************************************************
             * TAB de documentacion adjunta
             *****************************************************/
            Tabs\Tab::make('Documentación')
            ->icon('heroicon-m-document-duplicate')
                ->schema([
                    Repeater::make('Documentación')
                    ->label('')
                    ->relationship('contratodocumentos')
                    ->addActionLabel('Agrega Documento')
                    ->reorderableWithButtons()
                    ->defaultItems(0)
                    ->cloneable()
                    ->columns(6)
                    ->schema([
                        //Hidden::make('tipo')->default('rlegal'),
                        Select::make('tipo')
                            ->options([
                                'escritura' => 'Escritura',
                                'actadirectorio' => 'Acta directorio',
                                'constitucion' => 'Constitución sociedad',
                                'certvigencia' => 'Certificado de vigencia',
                                'rutreplegal' => 'C.I. representante legal',
                                'rutsii' => 'RUT del SII',
                                'contrato' => 'Contrato firmado',
                                'otro' => 'Otro',
                            ])
                            ->required()
                            //->autofocus()
                            ->searchable()
                            ->columnSpan(2),
                        TextInput::make('observacion')
                            ->label('Observación')
                            ->disableAutocomplete()
                            //->required()
                            ->columnSpan(2)
                            //->minLength(5)
                            ->maxLength(50),
                        FileUpload::make('documento')
                            ->label('Documento adjunto')
                            ->acceptedFileTypes(['application/pdf','application/doc','application/docx','application/xls','application/xlsx','image/jpg','image/jpeg','image/png'])
                            ->directory('documentos/contratos')
                            ->maxSize(4096)
                            ->preserveFilenames()
                            ->downloadable()
                            ->previewable()
                            ->required()
                            ->columnSpan(2)
                            ,
                        ]) //->schema([     del input "Repeater::make('Representante legal')"
                    ]), //->schema([     "del Tabs\Tab::make('Documentación')"



            /******************************************************
             * TAB de contactos, Rep.Legal, coordinador, DTE, Pago
             * Proveedores y autorizados para retirar productos
             *****************************************************/
            Tabs\Tab::make('Contactos')
            ->icon('heroicon-m-user-group')
                ->schema([ //principal de "Contactos"
                    /*******************************************************
                     * Seccion ingreso "Representante legal"
                     *******************************************************/
                    Section::make('Representante Legal')  //Representante Legal
                    ->schema([
                        Repeater::make('Representante Legal')
                        ->label('')
                        ->relationship('contratoreplegals')
                        ->addActionLabel('Agrega Representante legal')
                        ->reorderableWithButtons()
                        //->defaultItems(1)
                        //->minItems(1)
                        ->maxItems(3)
                        ->cloneable()
                        ->columns(12)
                        ->schema([
                            //Hidden::make('tipo')->default('rlegal'),
                            Select::make('titulo')
                                ->label('Titulo')
                                ->options([
                                    'don' => 'don',
                                    'doña' => 'doña',
                                ])
                                ->default('don')
                                ->required()
                                ->autofocus()
                                //->searchable()
                                ->columnSpan(2),
                            TextInput::make('nombre')
                                ->label('Representante Legal')
                                ->disableAutocomplete()
                                ->required()
                                ->columnSpan(7)
                                ->minLength(5)
                                ->maxLength(150),
                                //->unique(ignoreRecord: true),
                            TextInput::make('rut')
                                ->label('R.U.T')
                                ->disableAutocomplete()
                                ->required()
                                ->mask('99.999.999-*')
                                /*->mask(RawJs::make(<<<'JS'
                                    $input.startsWith('34') || $input.startsWith('37') ? '99.999.999-*' : '99.999.999-9'
                                    JS)) */
                                ->columnSpan(3)
                                ->minLength(10)
                                ->maxLength(15),
                                //->unique(ignoreRecord: true),
                            TextInput::make('telefono')
                                ->label('Telefono')
                                ->disableAutocomplete()
                                //->required()
                                //->prefixIcon('heroicon-m-phone')
                                ->prefix('(+56)')
                                ->tel()
                                ->mask('9 9999 9999')
                                ->columnSpan(3)
                                ->minLength(1)
                                ->maxLength(30),
                            TextInput::make('celular')
                                ->label('Celular')
                                ->disableAutocomplete()
                                //->required()
                                //->prefixIcon('heroicon-m-device-phone-mobile')
                                ->prefix('(+56)')
                                ->tel()
                                ->mask('9 9999 9999')
                                ->columnSpan(3)
                                ->minLength(1)
                                ->maxLength(30),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->prefixIcon('heroicon-m-envelope')
                                ->disableAutocomplete()
                                ->required()
                                ->columnSpan(6)
                                ->minLength(10)
                                ->maxLength(150),
                        ]) //->schema([     del input "Repeater::make('Representante legal')"
                    ]), //->schema([     "Section::make('')  //Representante Legal"

                    /*******************************************************
                     * Seccion ingreso "Pago Proveedores"
                     *******************************************************/
                    Section::make('Pago a proveedores')  //Pago Proveedores
                    ->schema([
                        Repeater::make('Pago a proveedores')
                        ->label('')
                        ->relationship('contratopagoproveedors')
                        ->addActionLabel('Agrega Pago a proveedor')
                        ->reorderableWithButtons()
                        ->defaultItems(0)
                        ->cloneable()
                        ->columns(12)
                        ->schema([
                            //---------------//Hidden::make('tipo')->default('pagop'),
                            TextInput::make('nombre')
                                ->label('Nombre')
                                ->disableAutocomplete()
                                ->required()
                                ->columnSpan(8)
                                ->autofocus()
                                ->minLength(5)
                                ->maxLength(150),
                                //->unique(ignoreRecord: true),
                            TextInput::make('telefono')
                                ->label('Telefono')
                                ->disableAutocomplete()
                                //->required()
                                //->prefixIcon('heroicon-m-phone')
                                ->prefix('(+56)')
                                ->tel()
                                ->mask('9 9999 9999')
                                ->columnSpan(4)
                                ->minLength(1)
                                ->maxLength(30),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->prefixIcon('heroicon-m-envelope')
                                ->disableAutocomplete()
                                ->required()
                                ->columnSpan(8)
                                ->minLength(10)
                                ->maxLength(150),
                            TextInput::make('celular')
                                ->label('Celular')
                                ->disableAutocomplete()
                            //->required()
                                //->prefixIcon('heroicon-m-device-phone-mobile')
                                ->prefix('(+56)')
                                ->tel()
                                ->mask('9 9999 9999')
                                ->columnSpan(4)
                                ->minLength(1)
                                ->maxLength(30),
                        ]) //->schema([     del input "Repeater::make('Pago Proveedores')"
                    ]), //->schema([     "Section::make('')  //Pago Proveedores"

                    /*******************************************************
                     * Seccion ingreso "DTE"
                     *******************************************************/
                    Section::make('Correo Factura Electronica')  //DTE
                    ->schema([
                        Repeater::make('Correo Factura Electronica')
                        ->label('')
                        ->relationship('contratodtemails')
                        ->addActionLabel('Agrega Correo DTE')
                        ->reorderableWithButtons()
                        ->defaultItems(0)
                        ->cloneable()
                        ->columns(4)
                        ->schema([
                            //---------------//Hidden::make('tipo')->default('dte'),
                            TextInput::make('email')
                                ->label('')
                                ->email()
                                //->prefix('eMail')
                                ->prefixIcon('heroicon-m-envelope')
                                ->disableAutocomplete()
                                ->required()
                                ->autofocus()
                                ->columnSpan(4)
                                ->minLength(10)
                                ->maxLength(150),
                        ]) //->schema([     del input "Repeater::make('Correo Factura Electronica')"
                    ]), //->schema([     "Section::make('')  //Correo Factura Electronica"

                    /*******************************************************
                     * Seccion ingreso "Coordinador"
                     *******************************************************/
                    Section::make('Coordinador')  //Coordinador
                    ->schema([
                        Repeater::make('Coordinador')
                        ->label('')
                        ->relationship('contratocoordinadors')
                        ->addActionLabel('Agrega Coordinador')
                        ->reorderableWithButtons()
                        ->defaultItems(0)
                        ->cloneable()
                        ->columns(12)
                        ->schema([
                            //---------------//Hidden::make('tipo')->default('coord'),
                            TextInput::make('nombre')
                                ->label('Nombre Coordinador')
                                ->disableAutocomplete()
                                ->required()
                                ->autofocus()
                                ->columnSpan(8)
                                ->minLength(5)
                                ->maxLength(150),
                                //->unique(ignoreRecord: true),
                            TextInput::make('telefono')
                                ->label('Telefono')
                                ->disableAutocomplete()
                                //->required()
                                //->prefixIcon('heroicon-m-phone')
                                ->prefix('(+56)')
                                ->tel()
                                ->mask('9 9999 9999')
                                ->columnSpan(4)
                                ->minLength(1)
                                ->maxLength(30),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->prefixIcon('heroicon-m-envelope')
                                ->disableAutocomplete()
                                ->required()
                                ->columnSpan(8)
                                ->minLength(10)
                                ->maxLength(150),
                            TextInput::make('celular')
                                ->label('Celular')
                                ->disableAutocomplete()
                                //->required()
                                //->prefixIcon('heroicon-m-device-phone-mobile')
                                ->prefix('(+56)')
                                ->tel()
                                ->mask('9 9999 9999')
                                ->columnSpan(4)
                                ->minLength(1)
                                ->maxLength(30),
                        ]) //->schema([     del input "Repeater::make('Coordinador')"
                    ]), //->schema([     "Section::make('')  //Coordinador"

                    /*******************************************************
                     * Seccion ingreso "Poderes para autorizar retiros"
                     *******************************************************/
                    Section::make('Poderes para autorizar retiros')  //Poderes para autorizar retiros
                    ->schema([
                        Repeater::make('Poderes para autorizar retiros')
                        ->label('')
                        ->relationship('contratoautretiros')
                        ->addActionLabel('Agrega Poder para Retiro')
                        ->reorderableWithButtons()
                        ->defaultItems(0)
                        ->columns(12)
                        ->schema([
                            //---------------//Hidden::make('tipo')->default('retiro'),
                            TextInput::make('nombre')
                                ->label('Nombre autorizado')
                                ->disableAutocomplete()
                                ->required()
                                ->autofocus()
                                ->columnSpan(9)
                                ->minLength(5)
                                ->maxLength(150),
                                //->unique(ignoreRecord: true),
                            TextInput::make('rut')
                                ->label('R.U.T')
                                ->disableAutocomplete()
                                ->required()
                                ->mask('99.999.999-*')
                                /*->mask(RawJs::make(<<<'JS'
                                    $input.startsWith('34') || $input.startsWith('37') ? '99.999.999-*' : '99.999.999-9'
                                    JS)) */
                                ->columnSpan(3)
                                ->minLength(10)
                                ->maxLength(15),
                                //->unique(ignoreRecord: true),
                            TextInput::make('telefono')
                                ->label('Telefono')
                                ->disableAutocomplete()
                                //->required()
                                //->prefixIcon('heroicon-m-phone')
                                ->prefix('(+56)')
                                ->tel()
                                ->mask('9 9999 9999')
                                ->columnSpan(3)
                                ->minLength(1)
                                ->maxLength(30),
                            TextInput::make('celular')
                                ->label('Celular')
                                ->disableAutocomplete()
                                //->required()
                                //->prefixIcon('heroicon-m-device-phone-mobile')
                                ->prefix('(+56)')
                                ->tel()
                                ->mask('9 9999 9999')
                                ->columnSpan(3)
                                ->minLength(1)
                                ->maxLength(30),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->prefixIcon('heroicon-m-envelope')
                                ->disableAutocomplete()
                                ->required()
                                ->columnSpan(6)
                                ->minLength(10)
                                ->maxLength(150),
                        ]) //->schema([     del input "Repeater::make('Poderes para autorizar retiros')"
                    ]), //->schema([     "Section::make('')  //Poderes para autorizar retiros"

                    /*******************************************************
                     * Seccion ingreso "correo para envio de guias x correo"
                     *******************************************************/
                    Section::make('Correo para Guias')
                    ->schema([
                        Repeater::make('Correo para envio de Guias')
                        ->label('')
                        ->relationship('contratoguiamails')
                        ->addActionLabel('Agrega Correo')
                        ->reorderableWithButtons()
                        ->defaultItems(0)
                        ->cloneable()
                        ->columns(4)
                        ->schema([
                            //---------------//Hidden::make('tipo')->default('dte'),
                            TextInput::make('email')
                                ->label('')
                                ->email()
                                //->prefix('eMail')
                                ->prefixIcon('heroicon-m-envelope')
                                ->disableAutocomplete()
                                ->required()
                                ->autofocus()
                                ->columnSpan(4)
                                ->minLength(10)
                                ->maxLength(150),
                        ]) //->schema([     Repeater::make('Correo para envio de Guias')
                    ]), //->schema([     Section::make('Correo para Guias')

                ]), //->schema([ //principal de "Contactos"



            /******************************************************
             * TAB de Tarifas, solo se deben especificar las
             * tarifas que son propias del cliente y salen del
             * standard de la lista de precios
             *****************************************************/
            Tabs\Tab::make('Tarifas')
                ->icon('heroicon-m-currency-dollar')
                ->schema([
                    Repeater::make('Valores por Cliente')
                    ->label('')
                    ->relationship('contratovalors')
                    ->addActionLabel('Agrega Valor por Cliente')
                    ->reorderableWithButtons()
                    ->defaultItems(0)
                    ->cloneable()
                    ->columns(12)
                    ->schema([
                        Select::make('servicio_id')
                            ->label('Servicio')
                            ->columnSpan(10)
                            ->required()
                            ->options(Servicio::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('descripcion')->pluck('descripcion','id'))
                            ->searchable(),
                        TextInput::make('valor')
                            ->label('Valor')
                            //->id('largo')
                            //->required()
                            ->columnSpan(2)
                            ->numeric()
                            //->live()->dehydrated()
                            ->inputMode('decimal',4)
                            ->default(0),
                    ]) //->schema([     del input "Repeater::make('Tarifas')"
                ]), //->schema([     "del Tabs\Tab::make('Tarifas')"


            /******************************************************
             * TAB de Garantia, si el C.Costoes garantias, debe
             * pediro los datos correspondientes al pago de garantia
             *****************************************************/
            Tabs\Tab::make('Garantia')
                ->icon('heroicon-m-currency-dollar')
                ->visible(fn ($record) => $record->ccosto->garantia ?? false)  //el Tab de "Garantia" solo aparecera con el campo en true
                ->schema([
                    Section::make('Pago de Garantia')
                    ->disabled(fn ($record) => $record->garantiaReciboGenerado ?? false)
                    ->schema([
                        Toggle::make('garantiaPago')
                            ->label('¿El cliente pago la garantia?')
                            ->columnSpan(6)
                            ->default(true)
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark')
                            ->onColor('success')
                            ->offColor('danger')
                            ->disabled(fn ($record) => $record->garantiaReciboGenerado ?? false)
                            //->disabled(fn ($record) => $record && $record->garantiaReciboGenerado) // Deshabilitar el toggle si el recibo fue generado
                            ,
                        TextInput::make('garantiaMontoPago')
                            ->label('Monto pagado')
                            ->minValue('0')
                            ->maxValue('99999999')
                            //->stripCharacters(',')
                            ->columnSpan(3)
                            ->integer(),
                        DatePicker::make('garantiaFechaPago')
                            ->label('Fecha del pago')
                            //->required()
                            ->columnSpan(3)
                            ->native(false)
                            ->firstDayOfWeek(1)
                            ->suffixIcon('heroicon-m-calendar-days'),
                        Textarea::make('garantiaObservacionPago')
                            ->label('Observaciones del pago')
                            ->columnSpan(6)
                            ->rows(5)
                            ->maxLength(1000),
                        //RichEditor::make('garantiaObservacionPago')
                        //    ->label('Observaciones del pago')
                        //    ->columnSpan(6)
                        //    ->toolbarButtons([
                        //        'blockquote',
                        //        'bold',
                        //        'bulletList',
                        //        'codeBlock',
                        //        'italic',
                        //        'orderedList',
                        //        'redo',
                        //        'strike',
                        //        'underline',
                        //        'undo',
                        //    ])
                        //    ->maxLength(1000),
                    ])->columns(6), //Section::make('Pago de Garantia')

                    Section::make('Devolución de Garantia')
                    ->schema([
                        Toggle::make('garantiaDevolucion')
                            ->label('¿Se devolvio la garantia al cliente?')
                            //->required()
                            ->columnSpan(6)
                            ->default(true)
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark')
                            ->onColor('success')
                            ->offColor('danger'),
                        TextInput::make('garantiaMontoDevolucion')
                            ->label('Monto devuelto')
                            //->required()
                            ->minValue('0')
                            ->maxValue('99999999')
                            //->stripCharacters(',')
                            ->columnSpan(3)
                            ->integer(),
                        DatePicker::make('garantiaFechaDevolucion')
                            ->label('Fecha devolución')
                            //->required()
                            ->columnSpan(3)
                            ->native(false)
                            ->firstDayOfWeek(1)
                            ->suffixIcon('heroicon-m-calendar-days'),
                        Textarea::make('garantiaObservacionDevolucion')
                            ->label('Observaciones de la devolución')
                            ->columnSpan(6)
                            ->rows(5)
                            ->maxLength(1000),
                        //RichEditor::make('garantiaObservacionDevolucion')
                        //    ->label('Observaciones de la devolución')
                        //    ->columnSpan(6)
                        //    ->toolbarButtons([
                        //        'blockquote',
                        //        'bold',
                        //        'bulletList',
                        //        'codeBlock',
                        //        'italic',
                        //        'orderedList',
                        //        'redo',
                        //        'strike',
                        //        'underline',
                        //        'undo',
                        //    ])
                        //    ->maxLength(1000),
                    ])->columns(6), //Section::make('Devolución de Garantia')

                ]), //->schema([     "del Tabs\Tab::make('Garantia')"




            ]), //->tabs([      este es el "tabs" principal

        ]), //->schema([   "Forms\Components\Card::make()"
        ])->columns(12); //->schema([   "del return $form"
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('empresa_id', auth()->user()->empresa_id);
    }

    public static function table(Table $table): Table
    {
        //dd(Ccosto::where('empresa_id', auth()->user()->empresa_id)->where('vigente',true)->pluck('codigo', 'id')->toArray());
        return $table
            ->columns([
                //TextColumn::make('ccosto.codigo')
                TextColumn::make('ccosto.codigo')
                    ->label('C.Costo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('folioContrato')
                    ->label('Folio')
                    ->searchable()
                    ->sortable(),
                //TextColumn::make('cliente.nombre')
                TextColumn::make('cliente.nombre')
                    ->label('Nombre/Razón social')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'elab' => 'Elaboración',
                            'docum' => 'Documentación',
                            'firma' => 'Firma',
                            'revision' => 'Revisión',
                            'completo' => 'Completo',
                            'nulo' => 'Nulo',
                            default => $state, // Muestra el valor original si no coincide
                        };
                    })
                    ->color(function ($state) {
                        return match ($state) {
                            'completo' => 'primary',
                            'nulo' => 'danger',
                            default => 'gray',
                        };
                    })
                    ->extraAttributes(function ($state) {
                        return ['style' => 'font-weight: bold;']; // Aplica negrita al texto
                    }),

                IconColumn::make('vigente')
                    ->label('Vigente')
                    ->boolean()
                    ->sortable()
                    ->alignCenter()
                    ->action(function($record, $column){
                        $name = $column->getName();
                        $record->update([
                            $name => !$record->$name
                        ]);
                    }),
            ])

            ->filters([
                SelectFilter::make('ccosto_id')
                    ->label('Centro de Costo')
                    ->placeholder(null) // Elimina la opción "TODOS"
                    ->options(fn () => Ccosto::where('empresa_id', auth()->user()->empresa_id)
                        ->where('vigente', true)
                        ->orderBy('descripcion')
                        ->pluck('descripcion', 'id')
                        ->toArray())
                    ->default(function () {
                        return Ccosto::where('empresa_id', auth()->user()->empresa_id)
                            ->where('vigente', true)
                            ->orderBy('descripcion')
                            ->value('id');
                    }),
                ], layout: FiltersLayout::AboveContent)  // filtros arriba antes de la tabla
                ->paginated()
/*                
                SelectFilter::make('ccosto_id')
                    ->label('Centro de Costo')
                    //->disablePlaceholder() // Elimina la opción "TODOS"
                    ->placeholder(null) // Elimina la opción "TODOS" o el placeholder vacío
                    ->options(fn () => Ccosto::where('empresa_id', auth()->user()->empresa_id)
                        ->where('vigente', true)
                        ->orderBy('descripcion') // Ordenar por el campo 'codigo'
                        ->pluck('descripcion', 'id')
                        ->toArray())
                    ->default(function () {
                        // Obtener el primer centro de costo disponible
                        return Ccosto::where('empresa_id', auth()->user()->empresa_id)
                            ->where('vigente', true)
                            ->orderBy('descripcion')
                            ->value('id'); // Retorna el primer 'id'
                    }),
            ], layout: FiltersLayout::AboveContent) // Coloca los filtros por encima del contenido
            ->paginated()
*/            
            ->actions([
                Action::make('generarRecibo')
                    ->label('Garantía')
                    ->icon('heroicon-o-document-text') // Icono para el botón
                    ->url(fn (Contrato $record): string => route('contratos.recibopagogarantia', $record->id))
                    ->openUrlInNewTab() // Abre el PDF en una nueva pestaña
                    ->button() // Convierte la acción en un botón
                    ->color('primary') // Establece el color del botón a azul (color primario)
                    ->visible(fn (Contrato $record) => 
                        ($record->ccosto->garantia ?? false) &&
                        ($record->garantiaPago ?? true) &&
                        ($record->garantiaMontoPago) > 0 &&
                        ($record->garantiaFechaPago !== null) 
                    ), // Muestra el botón solo si todas las condiciones son verdaderas
                Action::make('generarContrato')
                    ->label('Contrato')
                    ->icon('heroicon-o-pencil-square') // Icono para el botón
                    ->url(fn (Contrato $record): string => route('contratos.contrato', $record->id))
                    ->openUrlInNewTab() // Abre el PDF en una nueva pestaña
                    ->button() // Convierte la acción en un botón
                    ->color('success') // Establece el color del botón a azul (color primario)
                    ,
                ActionGroup::make([
                    ViewAction::make()->label('Ver')->closeModalByClickingAway(false)->color('gray'),
                    EditAction::make()->label('Modificar')->closeModalByClickingAway(false)->color('info'),
                    DeleteAction::make()->label('Borrar')->closeModalByClickingAway(false)->color('danger'),
                    ])->icon('heroicon-m-ellipsis-vertical')
                ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                /* Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]), */
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Crear Contrato')->closeModalByClickingAway(false),
            ]);
    }
    
    /*
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    */
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContratos::route('/'),
            'create' => Pages\CreateContrato::route('/create'),
            'edit' => Pages\EditContrato::route('/{record}/edit'),
            //'show' => Pages\ShowContrato::route('/{record}'),
        ];
    }    
}
