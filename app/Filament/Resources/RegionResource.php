<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionResource\Pages;
use App\Filament\Resources\RegionResource\RelationManagers;
use App\Models\Region;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Enums\ActionsPosition;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';
    protected static ?string $navigationLabel = 'Regiones';
    protected static ?int $navigationSort =7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->columns(6)
                ->schema([
                    TextInput::make('codigo')
                        ->label('Código región')
                        ->placeholder('RM')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(1)
                        ->minLength(2)
                        ->maxLength(20)
                        //->live(onBlur: true)
                        ->unique(ignoreRecord: true),
                    TextInput::make('nombre')
                        ->label('Nombre región')
                        ->placeholder('Región Metropolitana')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(5)
                        ->minLength(10)
                        ->maxLength(100)
                        ->unique(ignoreRecord: true),
                    Toggle::make('vigente')
                        ->label('Región Vigente/No vigente')
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
        ->defaultSort('nombre', 'asc')
            ->columns([
                TextColumn::make('codigo')
                    ->label('Cod.')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nombre')
                    ->label('Región')
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
            ->bulkActions([ /*
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ManageRegions::route('/'),
        ];
    }    
}
