<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CcostoResource\Pages;
use App\Filament\Resources\CcostoResource\RelationManagers;
use App\Models\Ccosto;
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

class CcostoResource extends Resource
{
    protected static ?string $model = Ccosto::class;
    
    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';
    protected static ?string $navigationLabel = 'Centro de Costos';
    protected static ?int $navigationSort = 3;
    protected static bool $hasTitleCaseModelLabel = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Card::make()->columns(4)
            ->schema([
                TextInput::make('codigo')
                    ->label('Centro de Costo')
                    ->placeholder('Adm')
                    ->autofocus()
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(1)
                    ->maxLength(10)
                    ->unique(ignoreRecord: true),
                TextInput::make('descripcion')
                    ->label('Descripcion C.Costo')
                    ->placeholder('Administración')
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(3)
                    ->maxLength(40)
                    ->unique(ignoreRecord: true),
                Toggle::make('vigente')
                    ->label('C.Costo Vigente/No vigente')
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
            ->defaultSort('codigo', 'asc')
            ->columns([
                TextColumn::make('codigo')
                    ->label('C.Costo')
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
                ]),
            */ ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->closeModalByClickingAway(false),
        ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCcostos::route('/'),
        ];
    }    
}

/*
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CcostoResource\Pages;
use App\Filament\Resources\CcostoResource\RelationManagers;
use App\Models\Ccosto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CcostoResource extends Resource
{
    protected static ?string $model = Ccosto::class;

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
            'index' => Pages\ManageCcostos::route('/'),
        ];
    }    
}
*/
