<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ciudad;
//use App\Models\Ciudad;
use App\Models\Comuna;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ComunaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ComunaResource\RelationManagers;

class ComunaResource extends Resource
{
    protected static ?string $model = Comuna::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationLabel = 'Comunas';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->columns(4)
                ->schema([
                    TextInput::make('nombre')
                        ->label('Nombre Comuna')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(2)
                        ->autofocus()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->unique(ignoreRecord: true),
                    Select::make('Ciuidad_id')
                        ->label('Ciudad')
                        ->columnSpan(2)
                        //->multiple()
                        ->relationship('ciudad', 'nombre')->preload()
                        //->options(Ciudad::where('vigente','=',true)->orderBy('nombre')->pluck('nombre','id'))
                        //->getSearchResultsUsing(fn (string $search): array => Ciudad::where('nombre', 'like', "%{$search}%")->limit(50)->pluck('nombre', 'id')->toArray())
                        //->getOptionLabelUsing(fn ($value): ?string => Ciudad::find($value)?->nombre)
                        ->searchable()
                        ,
                    Toggle::make('vigente')
                        ->label('Comuna Vigente/No vigente')
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

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('ciudad.nombre', 'asc')
            ->columns([
                TextColumn::make('ciudad.nombre')
                    ->label('Ciudad')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nombre')
                    ->label('Comuna')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('vigente')
                    ->label('Vigente')
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Ver')->closeModalByClickingAway(false),
                Tables\Actions\EditAction::make()->label('Modificar')->closeModalByClickingAway(false),
                Tables\Actions\DeleteAction::make()->label('Borrar')->closeModalByClickingAway(false),
            ])
            ->bulkActions([
                /* Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]), */
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Crear Comuna')->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageComunas::route('/'),
        ];
    }    
}
