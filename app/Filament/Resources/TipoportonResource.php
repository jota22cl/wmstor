<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Empresa;
use Filament\Forms\Form;
use App\Models\Tipoporton;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TipoportonResource\Pages;
use App\Filament\Resources\TipoportonResource\RelationManagers;
use Filament\Tables\Enums\ActionsPosition;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class TipoportonResource extends Resource
{
    protected static ?string $model = Tipoporton::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-start-on-rectangle';
    protected static ?string $navigationLabel = 'Tipo Porton';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()->columns(3)
            ->schema([
                //Llave empresa
                Hidden::make('empresa_id')->default(auth()->user()->empresa_id),

                TextInput::make('codigo')
                    ->label('Tipo Porton')
                    ->placeholder('Cortina')
                    ->autofocus()
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(40),
                    //->unique(ignoreRecord: true),

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
                ->label('Nuevo Tipo Porton')
                ->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTipoportons::route('/'),
        ];
    }    
}
