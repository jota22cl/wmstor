<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Operario;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
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
use App\Filament\Resources\OperarioResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OperarioResource\RelationManagers;

class OperarioResource extends Resource
{
    protected static ?string $model = Operario::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Operarios';
    protected static ?int $navigationSort = 15;
    protected static bool $hasTitleCaseModelLabel = false;


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()//->columns(4)
            ->schema([                
                //Llave empresa
                Hidden::make('empresa_id')->default(auth()->user()->empresa_id),

                TextInput::make('nombre')
                    ->label('Nombre Operario')
                    ->placeholder('Nombre Operario')
                    ->autofocus()
                    ->disableAutocomplete()
                    ->required()
                    //->columnSpan(1)
                    ->maxLength(2)
                    ->maxLength(40)
                    ->unique(ignoreRecord: true),
                Toggle::make('vigente')
                    ->label('Operario Vigente/No vigente')
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
            ->defaultSort('nombre', 'asc')
            ->columns([
                TextColumn::make('nombre')
                    ->label('Operario')
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
                ]),
            */ ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Crear Operario')->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageOperarios::route('/'),
        ];
    }    
}
