<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Moneda;
use App\Models\Pseguro;
use Filament\Forms\Form;
use Filament\Tables\Table;
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
use Filament\Tables\Enums\ActionsPosition;

use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PSeguroResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PSeguroResource\RelationManagers;

class PSeguroResource extends Resource
{
    protected static ?string $model = Pseguro::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'Prima de Seguros';
    protected static ?int $navigationSort =6;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()->columns(12)
            ->schema([
                //Llave empresa
                Hidden::make('empresa_id')->default(auth()->user()->empresa_id),

                TextInput::make('codigo')
                    ->label('Código')
                    ->placeholder('1.48')
                    ->autofocus()
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(10)
                    ->unique(ignoreRecord: true),
                TextInput::make('descripcion')
                    ->label('Descripción P. de Seguro')
                    ->placeholder('Prima de seguros 1.48%')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(8)
                    ->maxLength(40)
                    ->unique(ignoreRecord: true),
                TextInput::make('valor')
                    ->label('% P.Seguro')
                    ->placeholder('1.48')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(2)
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(99),
                    //->unique(ignoreRecord: true),

                DatePicker::make('periodoInicial')
                    ->label('Inicio P.Seguro')
                    //->required()
                    ->columnSpan(3)
                    ->native(false)
                    ->firstDayOfWeek(1)
                    ->suffixIcon('heroicon-m-calendar-days'),
                DatePicker::make('periodoFinal')
                    ->label('Termino P.Seguro')
                    //->required()
                    ->columnSpan(3)
                    ->native(false)
                    ->firstDayOfWeek(1)
                    ->suffixIcon('heroicon-m-calendar-days'),
                TextInput::make('polizaSeguro')
                    ->label('Nro.Poliza Seguro')
                    ->placeholder('1656-0')
                    ->disableAutocomplete()
                    //->required()
                    ->columnSpan(6)
                    ->maxLength(40),

                TextInput::make('ciaSeguro')
                    ->label('Compañia de Seguros')
                    ->placeholder('Renta nacional Compañia de Seuros Generales S.A.')
                    ->disableAutocomplete()
                    //->required()
                    ->columnSpan('full')
                    ->maxLength(200),

                Select::make('monedaDeducibleRoboIncendio_id')
                    ->label('Moneda')
                    ->placeholder('Sel.Moneda')
                    ->columnSpan(3)
                    //->required()
                    ->options(Moneda::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('simbolo')->pluck('simbolo','id'))
                    ->searchable(),
                TextInput::make('montoDeducibleRoboIncendio')
                    //->required()
                    ->label('Deducible Robo/Incendio')
                    ->numeric()
                    ->columnSpan(3)
                    ->default(0),

                Select::make('monedaDeducibleTerremoto_id')
                    ->label('Moneda')
                    ->placeholder('Sel.Moneda')
                    ->columnSpan(3)
                    //->required()
                    ->options(Moneda::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->orderBy('simbolo')->pluck('simbolo','id'))
                    ->searchable(),
                TextInput::make('montoDeducibleTerremoto')
                    //->required()
                    ->label('Deducible Terremoto')
                    ->numeric()
                    ->columnSpan(3)
                    ->default(0),

                Toggle::make('vigente')
                    ->label('P.Seguro Vigente/No vigente')
                    ->required()
                    ->columnSpan('full')
                    ->default(true)
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
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
            ->defaultSort('codigo', 'asc')
            ->columns([
                TextColumn::make('codigo')
                    ->label('P.Seguro')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('valor')
                    ->label('% G.Común')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('vigente')
                    ->label('Vigente/No vigente')
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
            ->bulkActions([ /*
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            */ ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePSeguros::route('/'),
        ];
    }    
}
