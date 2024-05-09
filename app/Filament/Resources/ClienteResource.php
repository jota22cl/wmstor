<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Comuna;
use App\Models\Cliente;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ClienteResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClienteResource\RelationManagers;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationGroup = 'Tablas Maestras';
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Clientes';
    protected static ?int $navigationSort = 1;
    
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()->columns(6)
            ->schema([
                TextInput::make('rut')
                    ->label('R.U.T')
                    ->disableAutocomplete()
                    ->required()
                    ->mask('99.999.999-*')
                    /*->mask(RawJs::make(<<<'JS'
                        $input.startsWith('34') || $input.startsWith('37') ? '99.999.999-*' : '99.999.999-9'
                        JS)) */
                    ->columnSpan(2)
                    ->minLength(10)
                    ->maxLength(15)
                    ->unique(ignoreRecord: true),
                TextInput::make('nombre')
                    ->label('Nombre/Razón social')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(4)
                    ->autofocus()
                    ->minLength(10)
                    ->maxLength(150)
                    ->unique(ignoreRecord: true),

                TextInput::make('sigla')
                    ->label('Sigla')
                    ->disableAutocomplete()
                    //->required()
                    ->columnSpan(2)
                    //->minLength(5)
                    ->maxLength(50)
                    ->unique(ignoreRecord: true),
                TextInput::make('giro')
                    ->label('Giro')
                    ->disableAutocomplete()
                    //->required()
                    ->columnSpan(4)
                    ->minLength(5)
                    ->maxLength(150)
                    ->unique(ignoreRecord: true),

                TextInput::make('direccion')
                    ->label('Direccion')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(4)
                    ->minLength(10)
                    ->maxLength(200),
                Select::make('comuna_id')
                    ->label('Comuna')
                    ->required()
                    ->columnSpan(2)
                    ->relationship('comuna', 'nombre')->preload()
                    ->searchable()
                    ,
                TextInput::make('telefono')
                    ->label('Telefono')
                    ->disableAutocomplete()
                    ->required()
                    ->prefixIcon('heroicon-m-phone')
                    ->prefix('(+56)')
                    ->tel()
                    ->mask('9 9999 9999')
                    ->columnSpan(2)
                    ->minLength(5)
                    ->maxLength(30),
                    
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->prefixIcon('heroicon-m-envelope')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(4)
                    ->minLength(10)
                    ->maxLength(150),

                RichEditor::make('observacion')
                    ->label('Observacion')
                    ->columnSpan(6)
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'italic',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->maxLength(1000),
                    

            
                Toggle::make('vigente')
                    ->label('Cliente Vigente/No vigente')
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
        ->defaultSort('nombre', 'asc')
        ->columns([
            TextColumn::make('rut')
                ->label('R.U.T.')
                ->searchable()
                ->sortable(),
            TextColumn::make('nombre')
                ->label('Nombre/Razón social')
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
                Tables\Actions\CreateAction::make()->label('Crear Cliente')->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageClientes::route('/'),
        ];
    }    
}
