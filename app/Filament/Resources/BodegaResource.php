<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Bodega;
use App\Models\Ccosto;
use App\Models\Empresa;
use Filament\Forms\Form;
use App\Models\Tipoporton;
use Filament\Tables\Table;
use Forms\Components\Card;
use App\Models\Tipoconstruccion;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BodegaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BodegaResource\RelationManagers;
//use App\Filament\Resources\BodegaResource\Widgets\BodegaChart;
use App\Filament\Resources\BodegaResource\Widgets\BodegaStatsOverview;

//use Closure;
//use Carbon\Carbon;

class BodegaResource extends Resource
{
    protected static ?string $model = Bodega::class;

    protected static ?string $navigationGroup = 'Tablas Maestras';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'Bodegas';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Card::make()->columns(12)
            ->schema([
                Hidden::make('empresa_id')
                    ->default('15'),
                    //->default('Almacenes Generales de Deposito Storage S.A.'),
                /*
                Select::make('empresa_id')
                    ->label('Empresa')
                    ->required()
                    ->columnSpan('full')
                    ->options(Empresa::where('vigente','=',true)->pluck('razonsocial','id'))
                    ->default('Almacenes Generales de Deposito Storage S.A.')
                    ->selectablePlaceholder(false)
                    ->hiddenOn(CommentsRelationManager::class)
                    //->relationship('empresa', 'razonsocial')->preload(),
                    ,
                */
                TextInput::make('codigo')
                    ->label('Cod.Bodega')
                    ->required()
                    ->autofocus()
                    ->columnSpan(3)
                    ->maxLength(10),
                TextInput::make('ubicacion')
                    ->label('Ubicación')
                    //->required()
                    ->columnSpan(9)
                    ->maxLength(50),


                Fieldset::make('Medidas de la bodega')->columns(3)
                ->schema([
                    TextInput::make('ancho')
                        ->label('Ancho')
                        ->id('ancho')
                        //->required()
                        ->columnSpan(1)
                        ->numeric()
                        ->default(0)
                        /*->afterStateUpdated(function (Closure $set, $state) {
                            $set('mt2calc', Carbon::parse($state)->mt2calc);
                        })
                        */,
                    TextInput::make('largo')
                        ->label('Largo')
                        ->id('largo')
                        //->required()
                        ->columnSpan(1)
                        ->numeric()
                        //->inputMode('decimal',2)
                        ->default(0),
                    TextInput::make('alto')
                        ->label('Alto')
                        ->id('alto')
                        //->required()
                        ->columnSpan(1)
                        ->numeric()
                        //->inputMode('decimal',2)
                        ->default(0),
                    TextInput::make('mt2')
                        ->label('Mt2 (facturable)')
                        ->required()
                        ->columnSpan(1)
                        ->numeric()
                        ->minValue(1)
                        ->default(0),
                    TextInput::make('mt2calc')
                        ->label('Mt2 (Calculado)')
                        ->id('mt2calc')
                        //->disabled()
                        //->dehydrated(false) // este atributo hace que no se grabe en la base de datos
                        ->columnSpan(1)
                        ->numeric()
                        ->default(0),
                    TextInput::make('mt3calc')
                        ->label('Mt3 (Calculado)')
                        ->id('mt3calc')
                        //->disabled()
                        //->dehydrated(false) // este atributo hace que no se grabe en la base de datos
                        ->columnSpan(1)
                        ->numeric()
                        ->default(0),
                ])->columnSpan(6),


                Fieldset::make('Referente al porton')->columns(2)
                ->schema([
                    TextInput::make('ancho_porton')
                        //->required()
                        ->label('Ancho porton')
                        ->numeric()
                        ->default(0),
                    TextInput::make('alto_porton')
                        //->required()
                        ->label('Alto porton')
                        ->numeric()
                        ->default(0),
                    TextInput::make('lateral_izq_porton')
                        //->required()
                        ->label('Lateral Izq. porton')
                        ->numeric()
                        ->default(0),
                    TextInput::make('lateral_der_porton')
                        //->required()
                        ->label('Lateral Der. porton')
                        ->numeric()
                        ->default(0),
                ])->columnSpan(6),

                Select::make('tipoporton_id')
                    ->label('Tipo de porton')
                    ->columnSpan(6)
                    //->required()
                    ->options(Tipoporton::where('vigente','=',true)->orderBy('codigo')->pluck('codigo','id')),
                Select::make('tipoconstruccion_id')
                    ->label('Tipo de construcción')
                    ->columnSpan(6)
                    //->required()
                    ->options(Tipoconstruccion::where('vigente','=',true)->orderBy('codigo')->pluck('codigo','id')),

                RichEditor::make('observacion')
                    ->label('Observación')
                    ->columnSpan(6)
                    //->maxSize(1000)
                    ->toolbarButtons(['blockquote','bold','bulletList','codeBlock','italic','orderedList','redo','strike','underline','undo',]),

                RichEditor::make('equipamiento')
                    ->label('Equipamiento')
                    ->columnSpan(6)
                    //->maxSize(1000)
                    ->toolbarButtons(['blockquote','bold','bulletList','codeBlock','italic','orderedList','redo','strike','underline','undo',]),


                Toggle::make('compartida')
                    ->label('Bodega compartida')
                    ->columnSpan(6)
                    ->required(),
                Toggle::make('vigente')
                    ->label('Bodega vigente')
                    ->columnSpan(6)
                    ->default(true)
                    ->required(),
                Toggle::make('medidasok')
                    ->label('Medidas confirmadas')
                    ->columnSpan(6)
                    ->required(),
                Toggle::make('ocupada')
                    ->label('Bodega ocupada')
                    ->columnSpan(6)
                    ->required(),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->label('Cod.Bodega')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ubicacion')
                    ->label('Ubicación')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('mt2')
                    ->label('Mt2')
                    ->numeric(decimalPlaces: 2)
                    ->alignRight()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ancho')
                    ->label('Ancho')
                    ->numeric(decimalPlaces: 2)
                    ->alignRight()
                    ->sortable(),
                Tables\Columns\TextColumn::make('largo')
                    ->label('Largo')
                    ->numeric(decimalPlaces: 2)
                    ->alignRight()
                    ->sortable(),
                Tables\Columns\IconColumn::make('compartida')
                    ->label('Compartida')
                    ->alignCenter()
                    ->toggleable()
                    ->sortable()
                    ->boolean(),
                Tables\Columns\IconColumn::make('ocupada')
                    ->label('Ocupada')
                    ->alignCenter()
                    ->toggleable()
                    ->sortable()
                    ->boolean(),
                Tables\Columns\IconColumn::make('vigente')
                    ->label('Vigente')
                    ->alignCenter()
                    ->sortable()
                    ->boolean(),
                Tables\Columns\IconColumn::make('medidasok')
                    ->label('Med.Conf.')
                    ->alignCenter()
                    ->toggleable()
                    ->sortable()
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('vigente')->label('Bod.Vigente')
                    ->options([
                        '1'  => 'Vigente',
                        '0'  => 'No vigente',
                    ])
                    ->default('1'),
                SelectFilter::make('Ocupada')->label('Bod.Ocupada')
                    ->options([
                        '1'  => 'Ocupada',
                        '0'  => 'No ocupada',
                    ]),
                SelectFilter::make('medidasok')->label('Med.Conf.')
                    ->options([
                        '1'  => 'Med.Confirmada',
                        '0'  => 'Med.No confirmada',
                    ]),
                SelectFilter::make('compartida')->label('Bod.Compartida.')
                    ->options([
                        '1'  => 'Compartida',
                        '0'  => 'No compartida',
                    ]),
                //Filter::make('ocupada')->toggle()->label('Bod.Ocupada'),
                //Filter::make('compartida')->toggle()->label('Bod.Compartida'),
                //Filter::make('medidasok')->toggle()->label('Medidas Ok'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Ver')->closeModalByClickingAway(false),
                Tables\Actions\EditAction::make()->label('Modificar')->closeModalByClickingAway(false),
                Tables\Actions\DeleteAction::make()->label('Borrar')->closeModalByClickingAway(false),
            ])
            ->bulkActions([
                /*
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                */
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->closeModalByClickingAway(false),
            ]);
    }
    
    //***********creada*********/
    /*
    public static function getRelations(): array
    {
        return [
            //
        ];
    } 
    */ 
    
    public static function getWidgets(): array
    {
        return [
            BodegaStatsOverview::class,
            //BodegaChart::class,
        ];
    }  

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBodegas::route('/'),
        ];
    }    
}
