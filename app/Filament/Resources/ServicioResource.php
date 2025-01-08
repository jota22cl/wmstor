<?php
namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Servicio;
use App\Models\Unimedida;
use Filament\Forms\Form;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Resource;
use App\Filament\Resources\ServicioResource\Pages;
use App\Filament\Resources\ServicioResource\RelationManagers;
use Filament\Tables\Enums\ActionsPosition;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class ServicioResource extends Resource
{
    protected static ?string $model = Servicio::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Servicios';
    protected static ?int $navigationSort = 13;

    public static function form(Form $form): Form
    {
        //dd(auth());
        /*
        dd(
            auth(),
            auth()->user()->id,
            auth()->user()->name,
            auth()->user()->email,
            auth()->user()->empresa_id,
            auth()->user()->empresa->razonsocial,
            auth()->user()->empresa->sigla,
            auth()->user()->empresa->direccion,
        );
        */
        //dd(auth()->id(),auth());
        //dd($_SESSION["empresa_id"],$_SESSION["empresa_name"],$_SESSION["empresa_sigla"],session());
        //dd($_SESSION["empresa_id"],$_SESSION["empresa_name"],$_SESSION["empresa_sigla"],auth());
        //dd(auth(),session());
        //dd(auth());
        return $form
            ->schema([
                Forms\Components\Card::make()->columns(4)
                ->schema([
                    //Llave empresa
                    Hidden::make('empresa_id')->default(auth()->user()->empresa_id),

                    TextInput::make('prioridad')
                        ->label('Prioridad')
                        //->placeholder('SBod')
                        ->autofocus()
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(1),
                    /*
                    TextInput::make('codigo')
                        ->label('Código de Servicio')
                        ->placeholder('SBod')
                        ->autofocus()
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(1)
                        ->minLength(2)
                        ->maxLength(15),
                        //->unique(ignoreRecord: true),
                    */
                    TextInput::make('descripcion')
                        ->label('Descripcion de Servicio')
                        ->placeholder('Servicio de Bodega')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(3)
                        ->minLength(5)
                        ->maxLength(50),
                        //->unique(ignoreRecord: true),

                    Select::make('unimed_ingreso_id')
                        ->label('Unidad de Ingreso')
                        ->columnSpan(2)
                        ->options(Unimedida::where('vigente','=',true)->pluck('descripcion','id')),
                    Select::make('unimed_cobro_id')
                        ->label('Unidad de Cobro')
                        ->columnSpan(2)
                        ->options(Unimedida::where('vigente','=',true)->pluck('descripcion','id')),

                    TextInput::make('factor_conversion')
                        ->label('Factor de conversión')
                        ->required()
                        ->columnSpan(2)
                        ->numeric()
                        //->minValue(1)
                        ->default(1),
                    TextInput::make('codigo_flexline')
                        ->label('Cod.Flexline (para Facturar)')
                        //->required()
                        ->columnSpan(2)
                        ->default(""),

                    Toggle::make('imprimeEnContrato')
                    ->label('Se imprime en el Contrato')
                        ->required()
                        ->columnSpan('full')
                        ->default(false)
                        ->onIcon('heroicon-o-check')
                        ->offIcon('heroicon-o-x-mark')
                        //->onIcon('heroicon-o-hand-thumb-up')
                        //->offIcon('heroicon-o-hand-thumb-down')
                        ->onColor('success')
                        ->offColor('danger'),

                    Toggle::make('vigente')
                    ->label('Estado Vigente/No vigente')
                        ->required()
                        ->columnSpan('full')
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
        return static::getModel()::query()->where('empresa_id', auth()->user()->empresa_id);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('prioridad', 'asc')
            ->columns([
                /*
                TextColumn::make('codigo')
                    ->label('Cod.Servicio')
                    ->searchable()
                    ->sortable(),
                */
                TextColumn::make('prioridad')
                    ->label('Prioridad')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('descripcion')
                    ->label('Ddescripción')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('imprimeEnContrato')
                    ->label('en Contrato')
                    ->boolean()
                    ->sortable()
                    ->alignCenter()
                    ->action(function($record, $column){
                        $name = $column->getName();
                        $record->update([
                            $name => !$record->$name
                        ]);
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
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()->label('Ver')->closeModalByClickingAway(false)->color('gray'),
                    EditAction::make()->label('Modificar')->closeModalByClickingAway(false)->color('info'),
                    DeleteAction::make()->label('Borrar')->closeModalByClickingAway(false)->color('danger'),
                ])->icon('heroicon-m-ellipsis-vertical')
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                /*
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                */
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nuevo Servicio')
                    ->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageServicios::route('/'),
        ];
    }    

}
