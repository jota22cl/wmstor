<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Moneda;
use Filament\Forms\Form;
use Filament\Tables\Table;
//use Forms\Components\Toggle;
use Illuminate\Validation\Rule;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
//use Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;

use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use App\Filament\Resources\MonedaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MonedaResource\RelationManagers;

class MonedaResource extends Resource
{
    protected static ?string $model = Moneda::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    //protected static ?string $navigationGroupIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Monedas'; //esto es en el menui "nav"
    protected static ?int $navigationSort = 2;

    /* ********* MUESTRA LA CANTIDAD DE REGISTROS SEGUN EL QUERY ***********
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->where('empresa_id', auth()->user()->empresa_id)->count();
    }
    */

    public static function form(Form $form): Form
    {
        //dd(auth()->user()->empresa_id);
        //dd($this->record->id);
        return $form
           ->schema([
            Forms\Components\Card::make()->columns(3)
            ->schema([
                //Llave empresa
                Hidden::make('empresa_id')->default(auth()->user()->empresa_id),

                TextInput::make('codigo')
                    ->label('Nombre Moneda')
                    ->placeholder('Peso')
                    ->autofocus()
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(30)
                      ->rules(Rule::unique('monedas', 'codigo')->where('empresa_id', auth()->user()->empresa_id)->ignore($this->record->id)),
                    //->rules(Rule::unique('monedas', 'codigo')->where('empresa_id', auth()->user()->empresa_id)),
                TextInput::make('simbolo')
                    ->label('Simbolo Moneda')
                    ->placeholder('$')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(1)
                    ->maxLength(10)
                    //->rules(Rule::unique('monedas', 'simbolo')->where('empresa_id', auth()->user()->empresa_id))->ignore($this->record->id),
                    ->rules(Rule::unique('monedas', 'simbolo')->where('empresa_id', auth()->user()->empresa_id)),
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
            ->defaultSort('codigo', 'asc')
            ->columns([
                TextColumn::make('codigo')
                    ->label('Nombre Moneda')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('simbolo')
                    ->label('Simbolo Moneda')
                    ->searchable()
                    ->sortable(),
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
                    //->align('center'),
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
            'index' => Pages\ManageMonedas::route('/'),
        ];
    }    
}

/*
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonedaResource\Pages;
use App\Filament\Resources\MonedaResource\RelationManagers;
use App\Models\Moneda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonedaResource extends Resource
{
    protected static ?string $model = Moneda::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMonedas::route('/'),
        ];
    }    
}
*/
