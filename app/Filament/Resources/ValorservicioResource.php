<?php
// app/Filament/Resources/ValorservicioResource.php
namespace App\Filament\Resources;

use App\Filament\Resources\ValorservicioResource\Pages;
use Filament\Forms;
use Filament\Tables;
use App\Models\Ccosto;
use App\Models\Servicio;
use App\Models\Valorservicio;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

use Illuminate\Support\Facades\DB;

class ValorservicioResource extends Resource
{
    protected static ?string $model = Valorservicio::class;

    protected static ?string $navigationGroup = 'Tablas Maestras';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Valor Servicios';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        $operation = $form->getOperation();
        //$metodo = $form->Method();
        //dd(session(),session()->all());
        //dd($operation);
        //dd($metodo);
        return $form
        //$form
        ->schema([
            Forms\Components\Card::make()->columns(4)
                ->schema([
                    //Llave empresa
                    Hidden::make('empresa_id')->default(auth()->user()->empresa_id),
                    //si la operacion es 'edit' solo muestra la fecha, si es 'create' pide la fecha
                    self::getFechaField($operation),
                    //aqui se despiega la grilla de input solo cuando la operacion es 'edit'
                    self::getGrillaDataField($operation),
                ])
            ]);
    }

    protected static function getFechaField(string $operation)
    {
        if ($operation == 'create') {  // cuando la operacion es crear.....
            $ultimaFecha = \App\Models\Valorservicio::where('empresa_id',auth()->user()->empresa_id)->max('fecha');
            if ($ultimaFecha == null) {$ultimaFecha = date("Y-m-d");}
            $fecha_actual = date("Y-m-d");
            $fecha3Meses = date("Y-m-d",strtotime($fecha_actual."+ 3 month"));
            return DatePicker::make('fecha')
                ->required()
                ->columnSpan(4)
                ->native(false)
                ->firstDayOfWeek(1)
                ->after($ultimaFecha)
                ->before($fecha3Meses)
                ->suffixIcon('heroicon-m-calendar-days');
        } else {  // de lo contrario, cuando se esta modificando.....
            return DatePicker::make('fecha')
                ->disabled()
                ->required()
                ->columnSpan(4)
                ->firstDayOfWeek(1)
                ->suffixIcon('heroicon-m-calendar-days');
        }
    }

    protected static function getGrillaDataField(string $operation)
    {   // eliminar despues el comentario del "if"
        //if ($operation != 'create') {
            return ViewField::make('valor_grid')
            //->view('components.valorservicio-grid', ['fecha' => '2024-06-07'])   //  esta linea no va, la deje como referencia
            ->view('components.valorservicio-grid', ['operation' => $operation])
            ->columnSpan(4);
        //}
    }
    

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()
        ->where('empresa_id', auth()->user()->empresa_id)
        ->where('lafecha',true)
        ;
    }


    public static function table(Table $table): Table
    {
        return $table
        ->defaultSort('fecha', 'desc')
        ->columns([
            TextColumn::make('fecha')
                ->label('Fecha')
                ->date($format='D d F Y')
                ->searchable()
                ->alignCenter()
                ->sortable(),
            ])
        ->filters([
            //
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListValorservicios::route('/'),
            'create' => Pages\CreateValorservicio::route('/create'),
            'edit' => Pages\EditValorservicio::route('/{record}/edit'),
        ];
    }
}
