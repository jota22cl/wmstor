<?php
namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
//use App\Rules\Uppercase;
use App\Models\Empresa;
use Filament\Forms\Form;
use App\Models\Lasmoneda;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Validation\Rules;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Group;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LasmonedaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LasmonedaResource\RelationManagers;
//

class LasmonedaResource extends Resource
{
    protected static ?string $model = Lasmoneda::class;

    protected static ?string $navigationGroup = 'x TEST';
    //protected static ?string $navigationGroupIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Las Monedas'; //esto es en el menui "nav"
    protected static ?int $navigationSort = 99;


    
    public static function form(Form $form): Form
    {
        dd($form);
        return $form
        ->schema([
            Forms\Components\Card::make()->columns(3)
            ->schema([
                Select::make('empresa_id')
                    ->label('Empresa')
                    ->columnSpan('full')
                    //->multiple()
                    //->relationship('empresa', 'razonsocial')->preload(),
                    ->options(Empresa::where('vigente','=',true)->pluck('razonsocial','id')),
                    // lal linea de arriba "->options()" funciona solo si se agrega "use App\Models\Empresa;"
                TextInput::make('codigo')
                    ->label('Nombre Moneda')
                    //->placeholder('Peso')
                    //->placeholder(auth()->id())
                    ->placeholder(auth()->id())


//                    $data['user_id'] = auth()->id();

                    ->autofocus()
                    ->disableAutocomplete()
                    //->extraAttributes(['style' => 'text-transform: Uppercase'])
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(30),
                    //->unique(ignoreRecord: true),
                TextInput::make('simbolo')
                    ->label('Simbolo Moneda UNIQUE')
                    ->placeholder('$')
                    //->rules([new Uppercase()])
                    ->extraAttributes(['style' => 'text-transform: Uppercase'])
                    ->disableAutocomplete()
                    ->required()
                    ->columnSpan(1)
                    ->maxLength(10)
                    //->unique(ignoreRecord: true),

                    ->unique(modifyRuleUsing: function (Unique $rule) {
                        return $rule
                        ->ignore($this->simbolo)
                        ->where('empresa_id',$this->empresa_id);
                    })

                    /*-----------------------------------------------------------------
                    Rule::unique('users')
                                    ->ignore($this->user)
                                    ->where('company_id', $this->company_id)
                    ------------------------------------------------------------------*/

                    ,

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

    public static function table(Table $table): Table
    {
        return $table
        ->defaultSort('codigo', 'asc')
        ->columns([
            TextColumn::make('codigo')
                ->label('Nombre Moneda')
                ->searchable()
                ->sortable(),
            TextColumn::make('simbolo')
                ->label('Simbolo Moneda')
                ->searchable()
                ->sortable(),
            IconColumn::make('vigente')
                ->label('Vigente')
                ->boolean()
                ->sortable()
                ->alignCenter(),
                //->align('center'),
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
            'index' => Pages\ManageLasmonedas::route('/'),
        ];
    }    
}
