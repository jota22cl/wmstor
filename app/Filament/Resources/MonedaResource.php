<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Moneda;
use Filament\Forms\Form;
use Filament\Tables\Table;
//use Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
//use Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MonedaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MonedaResource\RelationManagers;

class MonedaResource extends Resource
{
    protected static ?string $model = Moneda::class;

    protected static ?string $navigationGroup = 'Tablas Maestras';
    //protected static ?string $navigationGroupIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Monedas'; //esto es en el menui "nav"
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
           ->schema([
            Forms\Components\Card::make()->columns(3)
            ->schema([

                TextInput::make('codigo')
                    ->label('Nombre Moneda')
                    ->placeholder('Peso')
                    ->autofocus()
                    ->disableAutocomplete()
                    //->rules([new Uppercase()])
                    //->extraAttributes(['style' => 'text-transform: Uppercase'])
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(30)
                    ->unique(ignoreRecord: true),
                TextInput::make('simbolo')
                    ->label('Simbolo Moneda')
                    ->placeholder('$')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(1)
                    ->maxLength(10)
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
                    ->label('Vigente/No vigente')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                    //->align('center'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Ver'),
                Tables\Actions\EditAction::make()->label('Modificar'),
                Tables\Actions\DeleteAction::make()->label('Borrar'),
            ])
            ->bulkActions([ /*
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            */ ])
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
