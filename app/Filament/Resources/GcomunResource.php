<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Gcomun;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
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
use App\Filament\Resources\GcomunResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GcomunResource\RelationManagers;


class GcomunResource extends Resource
{
    protected static ?string $model = Gcomun::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';
    protected static ?string $navigationLabel = 'Gastos Comunes';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Card::make()->columns(4)
            ->schema([
                //Llave empresa
                Hidden::make('empresa_id')->default(auth()->user()->empresa_id),

                TextInput::make('codigo')
                    ->label('Gasto Común')
                    ->placeholder('10')
                    ->autofocus()
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(1)
                    ->maxLength(10)
                    ->rules(Rule::unique('gcomuns', 'codigo')->where('empresa_id', auth()->user()->empresa_id)),
                TextInput::make('descripcion')
                    ->label('Descripción Gasto Común')
                    ->placeholder('10% de Gasto Común')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(3)
                    ->maxLength(40)
                    ->rules(Rule::unique('gcomuns', 'descripcion')->where('empresa_id', auth()->user()->empresa_id)),
                TextInput::make('valor')
                    ->label('% G.Común')
                    ->placeholder('10')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(1)
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(99)
                    ->rules(Rule::unique('gcomuns', 'valor')->where('empresa_id', auth()->user()->empresa_id)),
                Toggle::make('vigente')
                    ->label('G.Común Vigente/No vigente')
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
                ->label('G.Común')
                ->searchable()
                ->sortable(),
            TextColumn::make('descripcion')
                ->label('Descripción')
                ->searchable()
                ->sortable(),
            TextColumn::make('valor')
                ->label('% G.Común')
                ->numeric()
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
                Tables\Actions\CreateAction::make()->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGcomuns::route('/'),
        ];
    }    
}

/*
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GcomunResource\Pages;
use App\Filament\Resources\GcomunResource\RelationManagers;
use App\Models\Gcomun;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GcomunResource extends Resource
{
    protected static ?string $model = Gcomun::class;

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
            'index' => Pages\ManageGcomuns::route('/'),
        ];
    }    
}
*/
