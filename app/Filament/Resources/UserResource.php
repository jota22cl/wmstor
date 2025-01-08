<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Livewire\Component as Livewire;
use Illuminate\Support\Facades\Hash;

use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Tables\Enums\ActionsPosition;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    
    protected static ?string $navigationGroup = 'Administración del Sistema';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $operation = $form->getOperation(); // 'create', 'view', 'edit'
        $isCreating = ($operation === 'create');
        //dd($operation, $isCreating);
        return $form
            ->schema([
                Select::make('empresa_id')
                    ->label('Empresa')
                    ->columnSpan('full')
                    ->relationship('empresa', 'razonsocial')->preload()
                    ->reactive()
                    ->disabled(!$isCreating),
                TextInput::make('name')
                    ->label('Nombre Usuario')
                    ->disableAutocomplete()
                    ->required()
                    ->autofocus()
                    ->maxLength(255),
                    //->unique(ignoreRecord: true),
                TextInput::make('email')
                    ->label('Correo electronico')
                    ->disableAutocomplete()
                    ->required()
                    ->email()
                    ->maxLength(255),
                    //->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->label('Clave')
                    ->disableAutocomplete()
                    ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                    ->password()
                    //->revealable()
                    ->prefixIcon('heroicon-m-key')
                    ->hiddenOn(['edit','view'])
                    ->minLength(8)
                    ->same('passwordConfirmation')
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                TextInput::make('passwordConfirmation')
                    ->label('Repita la clave')
                    ->disableAutocomplete()
                    ->password()
                    //->revealable()
                    ->prefixIcon('heroicon-m-key')
                    ->hiddenOn(['edit','view'])
                    ->required(fn (Page $livewire): bool => $livewire instanceof CreateRecord)
                    ->minLength(8)
                    ->dehydrated(false),
                Select::make('roles')
                    ->label('Rol')
                    ->multiple()
                    ->relationship('roles', 'name')->preload(),
                Select::make('permissions')
                    ->label('Permisos')
                    ->multiple()
                    ->relationship('permissions', 'name')->preload(),
                Select::make('ccostos')
                    ->label('Centros de Costo')
                    ->multiple()
                    ->relationship('ccostos', 'descripcion', fn ($query, $get) => 
                        $query->where('empresa_id', $get('empresa_id')) // Usa el valor seleccionado en 'empresa_id'
                    )
                    ->preload()
                    ->reactive(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('empresa.sigla', 'asc')
            ->columns([
                //TextColumn::make('id')->searchable(),
                TextColumn::make('empresa.sigla')->searchable()->sortable()
                    ->label('Sigla Emp.'),
                TextColumn::make('name')->searchable()->sortable()
                    ->label('Nombre Usuario'),
                TextColumn::make('email')->searchable()->sortable()
                    ->label('Correo electronico'),
                //TextColumn::make('created_at')->sortable()->dateTime('d-M-Y')
                //    ->label('Fec.Creación'),
            ])
            ->filters([
                SelectFilter::make('empresa')->label('Empresa')
                    ->relationship('empresa','sigla'),
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
            'index' => Pages\ManageUsers::route('/'),
        ];
    }    
}
