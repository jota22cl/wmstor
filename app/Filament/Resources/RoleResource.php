<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
//use Spatie\Permission\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Enums\ActionsPosition;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationGroup = 'Administración del Sistema';
    protected static ?string $navigationLabel = 'Roles';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    //protected static ?string $navigationIcon = 'heroicon-o-identification';
    //protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()->columns(8)
            ->schema([
                TextInput::make('name')
                    ->label('Nombre Rol')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(2)
                    ->autofocus()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->unique(ignoreRecord: true),
                Select::make('permissions')
                    ->label('Permisos')
                    ->columnSpan(6)
                    ->multiple()
                    ->relationship('permissions', 'name')->preload()
            ])
        ]);
    }

    /*
    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('empresa_id', auth()->user()->empresa_id);
    }
    */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //TextColumn::make('id')->searchable(),
                TextColumn::make('name')->searchable()->sortable()
                    ->label('Nombre Rol'),
                //TextColumn::make('created_at')->sortable()->dateTime('d-M-Y')
                //    ->label('Fec.Creación'),
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
                Tables\Actions\CreateAction::make()->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRoles::route('/'),
        ];
    }    
}
