<?php

namespace App\Filament\Resources;

use App\Models\Numeral;
use App\Models\Contrato;
use App\Models\Producto;
use App\Models\Productoperiodo;
use App\Models\Unimedida;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
//use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Resources\ProductoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductoResource\RelationManagers;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Productos';
    protected static ?string $navigationGroup = 'Gestión Bodega';
    protected static ?string $title = 'Productos del cliente';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    { 
        return $form
            ->schema([
                Forms\Components\Card::make()->columns(12)
                ->schema([
                    //Llave empresa
                    Hidden::make('empresa_id')->default(auth()->user()->empresa_id),

                    //Llave contrato
                    Hidden::make('contrato_id')->default(session('vssContratoId')),
    
                    TextInput::make('codigo')
                        ->label('Cod.Producto')
                        ->placeholder('COD001')
                        ->autofocus()
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(4)
                        ->maxLength(15),
                    TextInput::make('descripcion')
                        ->label('Descripción')
                        ->placeholder('Productos Varios')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(8)
                        ->maxLength(60),
                        //->unique(ignoreRecord: true),

                    Select::make('unimed_ingreso_id')
                        ->label('Un.Med.Ingreso')
                        ->columnSpan(4)
                        ->options(Unimedida::where('empresa_id','=',auth()->user()->empresa_id)
                            ->where('vigente','=',true)
                            ->pluck('descripcion','id'))
                        ->searchable()
                        ->required(),
                    Select::make('unimed_salida_id')
                        ->label('Un.Med.Salida')
                        ->columnSpan(4)
                        ->options(Unimedida::where('empresa_id','=',auth()->user()->empresa_id)
                            ->where('vigente','=',true)->pluck('descripcion','id'))
                        ->searchable()
                        ->required(),
                    TextInput::make('factor_conversion')
                        ->label('Factor de conversión')
                        ->columnSpan(4)
                        ->required()
                        ->numeric()
                        ->default(1),
    
                    TextInput::make('codbarra_bodega')
                        ->label('Cod.Barra Bodega')
                        ->columnSpan(6),
                    TextInput::make('codbarra_cliente')
                        ->label('Cod.Barra Cliente')
                        ->columnSpan(6),

                    TextInput::make('codbarra_ean13')
                        ->label('Cod.Barra EAN13')
                        ->columnSpan(6),
                    TextInput::make('codbarra_dun14')
                        ->label('Cod.Barra DUN14')
                        ->columnSpan(6),

                    TextInput::make('lote')
                        ->label('Lote')
                        ->columnSpan(5),
                    DatePicker::make('fechacaducidad')
                        ->label('Fecha de Caducidad')
                        ->columnSpan(3),
                    Select::make('unimed_ingreso_id')
                        ->label('Grupo Numeral')
                        ->columnSpan(4)
                        ->options(Numeral::where('empresa_id','=',auth()->user()->empresa_id)
                            ->where('vigente','=',true)->pluck('descripcion','id'))
                        ->searchable()
                        ->required(),
    
                    Toggle::make('inventariable')
                        ->label('Prod.C/Inventario')
                        ->required()
                        ->columnSpan(6)
                        //->columnSpan('full')
                        ->default(true)
                        ->onIcon('heroicon-o-check')
                        ->offIcon('heroicon-o-x-mark')
                        //->onIcon('heroicon-o-hand-thumb-up')
                        //->offIcon('heroicon-o-hand-thumb-down')
                        ->onColor('success')
                        ->offColor('danger'),
                    Toggle::make('vigente')
                        ->label('Estado Vigente/No vigente')
                        ->required()
                        ->columnSpan(6)
                        //->columnSpan('full')
                        ->default(true)
                        ->onIcon('heroicon-o-check')
                        ->offIcon('heroicon-o-x-mark')
                        //->onIcon('heroicon-o-hand-thumb-up')
                        //->offIcon('heroicon-o-hand-thumb-down')
                        ->onColor('success')
                        ->offColor('danger'),
                    ])
            ]);

    }

    
    public static function getEloquentQuery(): Builder
    {
        $customParam = session('vssContratoId');
        if ($customParam) {
            return static::getModel()::query()->where('empresa_id', auth()->user()->empresa_id)->where('contrato_id',$customParam);
        }else{
            //redirect()->route('filament.admin.pages.custom-producto');
            return static::getModel()::query()->where('empresa_id', 0);
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('codigo', 'asc')
            ->columns([
                TextColumn::make('codigo')
                    ->label('Cod.Prod.')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('inventariable')
                    ->label('Inv.')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                IconColumn::make('vigente')
                    ->label('Vigente/No vigente')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
            ])
            ->filters([
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()->label('Ver')->closeModalByClickingAway(false)->color('gray'),
                    EditAction::make()->label('Modificar')->closeModalByClickingAway(false)->color('info'),
                    DeleteAction::make()->label('Borrar')->closeModalByClickingAway(false)->color('danger'),
                ])->icon('heroicon-m-ellipsis-vertical')
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([ /*
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            */ ])
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }    


}
