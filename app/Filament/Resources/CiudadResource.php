<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ciudad;
//use App\Models\Region;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

use App\Filament\Resources\CiudadResource\Pages;
use App\Filament\Resources\CiudadResource\RelationManagers;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Enums\ActionsPosition;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class CiudadResource extends Resource
{
    protected static ?string $model = Ciudad::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Cuidades';
    protected static ?int $navigationSort = 8;
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->columns(4)
                ->schema([
                    TextInput::make('nombre')
                        ->label('Nombre Ciudad')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(2)
                        ->autofocus()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->unique(ignoreRecord: true),
                    Select::make('region_id')
                        ->label('Region')
                        ->columnSpan(2)
                        //->multiple()
                        ->relationship('region', 'nombre')->preload()
                        ->searchable(),
                    Toggle::make('vigente')
                        ->label('Ciudad Vigente/No vigente')
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
            ->defaultSort('region.nombre', 'asc')
            ->columns([
                TextColumn::make('region.nombre')
                    ->label('Región')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nombre')
                    ->label('Ciudad')
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
                /* Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]), */
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCiudads::route('/'),
        ];
    }    
}
