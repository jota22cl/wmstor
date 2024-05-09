<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Unimedida;
use Filament\Tables\Table;
use Forms\Components\Card;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UnimedidaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UnimedidaResource\RelationManagers;

class UnimedidaResource extends Resource
{
    protected static ?string $model = Unimedida::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical';
    protected static ?string $navigationLabel = 'Unidad de medida';
    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()->columns(4)
            ->schema([
                Hidden::make('empresa_id')
                    ->default('15'),
                    //->default('Almacenes Generales de Deposito Storage S.A.'),
                /*
                Select::make('empresa_id')
                    ->label('Empresa')
                    ->required()
                    ->columnSpan('full')
                    ->options(Empresa::where('vigente','=',true)->pluck('razonsocial','id'))
                    ->default('Almacenes Generales de Deposito Storage S.A.')
                    ->selectablePlaceholder(false)
                    ->hiddenOn(CommentsRelationManager::class)
                    //->relationship('empresa', 'razonsocial')->preload(),
                    ,
                */
                TextInput::make('codigo')
                    ->label('Unidad')
                    ->required()
                    ->autofocus()
                    ->columnSpan(1)
                    ->maxLength(15),
                TextInput::make('descripcion')
                    ->label('Descripción')
                    //->required()
                    ->columnSpan(3)
                    ->maxLength(50),


                Toggle::make('vigente')
                    ->label('Bodega vigente')
                    ->columnSpan(4)
                    ->default(true)
                    ->required(),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('codigo', 'asc')
            ->columns([
                TextColumn::make('codigo')
                    ->label('G.Común')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('descripcion')
                    ->label('Descripción')
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
            ->bulkActions([ /*
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]), */
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUnimedidas::route('/'),
        ];
    }    
}
