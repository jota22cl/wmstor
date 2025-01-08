<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ccosto;
use App\Models\Numeral;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NumeralResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NumeralResource\RelationManagers;

use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class NumeralResource extends Resource
{
    protected static ?string $model = Numeral::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    //protected static ?string $navigationGroupIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationIcon = 'heroicon-o-hashtag';
    protected static ?string $navigationLabel = 'Gr.Numeral'; //esto es en el menui "nav"
    protected static ?int $navigationSort = 15;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()->columns(3)
            ->schema([
                //Llave empresa
                Hidden::make('empresa_id')->default(auth()->user()->empresa_id),

                Select::make('ccosto_id')
                    ->label('C.Costo')
                    ->columnSpan(3)
                    ->required()
                    ->options(Ccosto::where('vigente','=',true)->where('numeral','=',true)->orderBy('descripcion')->pluck('descripcion','id')),

                TextInput::make('codigo')
                    ->label('Gr.Numeral')
                    ->placeholder('99')
                    ->autofocus()
                    ->disableAutocomplete()
                    //->rules([new Uppercase()])
                    //->extraAttributes(['style' => 'text-transform: Uppercase'])
                    ->required()
                    ->columnSpan(1)
                    ->maxLength(10)
                    ->unique(ignoreRecord: true),
                TextInput::make('descripcion')
                    ->label('Descripción')
                    ->placeholder('Productos Varios')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(40)
                    ->unique(ignoreRecord: true),

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
            ->columns([
                TextColumn::make('ccosto.descripcion')
                    ->label('C.Costo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('codigo')
                    ->label('Gr.Nmeral')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('vigente')
                    ->label('Vigente')
                    ->alignCenter()
                    ->sortable()
                    ->boolean()
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
                //Tables\Actions\BulkActionGroup::make([
                //    Tables\Actions\DeleteBulkAction::make(),
                //]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Nuevo Grupo Numeral')
                    ->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNumerals::route('/'),
        ];
    }    
}
