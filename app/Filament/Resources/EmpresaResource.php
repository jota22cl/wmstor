<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
//use App\Models\Comuna;
use App\Models\Empresa;
use Filament\Forms\Form;
use Filament\Tables\Table;
//use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
//use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
//use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EmpresaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmpresaResource\RelationManagers;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;

    protected static ?string $navigationGroup = 'Tablas Generales';
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Empresas';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form //->closeModalByClickingAway(false)
        ->schema([
            Forms\Components\Card::make()->columns(6)
                ->schema([
                    TextInput::make('razonsocial')
                        ->label('Razón social')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(4)
                        ->autofocus()
                        ->minLength(10)
                        ->maxLength(200)
                        ->unique(ignoreRecord: true),
                    TextInput::make('sigla')
                        ->label('Sigla')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(2)
                        ->minLength(5)
                        ->maxLength(50)
                        ->unique(ignoreRecord: true),

                    TextInput::make('rut')
                        ->label('R.U.T.')
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
                    TextInput::make('giro')
                        ->label('Giro')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(4)
                        ->minLength(5)
                        ->maxLength(200),

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
                        //->multiple()
                        ->relationship('comuna', 'nombre')->preload(),
/*
                    TextInput::make('ciudad.nombre')
                        ->label('Ciudad')
                        ->readonly()
                        ->columnSpan(3)
                        ->minLength(10)
                        ->maxLength(200),
                    TextInput::make('region.nombre')
                        ->label('Región')
                        ->readonly()
                        ->columnSpan(3)
                        ->minLength(10)
                        ->maxLength(200),
*/
                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->prefixIcon('heroicon-m-envelope')
                        ->disableAutocomplete()
                        ->required()
                        ->columnSpan(4)
                        ->minLength(10)
                        ->maxLength(150),
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
                ]),

                Forms\Components\Card::make()->columns(6)
                    ->schema([
                        TextInput::make('repl_nombre')
                            ->label('Representante legal')
                            ->disableAutocomplete()
                            ->required()
                            ->columnSpan(4)
                            ->minLength(10)
                            ->maxLength(150),
                        TextInput::make('repl_rut')
                            ->label('R.U.T.')
                            ->disableAutocomplete()
                            ->required()
                            ->mask('99.999.999-*')
                            ->columnSpan(2)
                            ->minLength(10)
                            ->maxLength(15),
                        TextInput::make('repl_email')
                            ->label('Email')
                            ->email()
                            ->prefixIcon('heroicon-m-envelope')
                            ->disableAutocomplete()
                            ->required()
                            ->columnSpan(4)
                            ->minLength(10)
                            ->maxLength(150),
                        TextInput::make('repl_telefono')
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
                    ]),

                Forms\Components\Card::make()->columns(6)
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->placeholder('Arrastra y suelta aquí tu archivo o da click para Examinar. 
                                IMPORTANTE: La imagen debe tener un aspecto de 16:9, su tamaño debe ser de 500 x 281.
                                Si no tiene el aspecto o tamaño indicado, la imagen sera forzada a esos valores.')
                            ->image()
                            ->directory('image/empresa')
                            ->preserveFilenames()
                            ->imageResizeMode('force')
                            //->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('500')
                            ->imageResizeTargetHeight('281')
                            //->columnSpan(2)
                            ->columnSpan(6)
                            ->maxSize(512),
                    ]),
            



                    /*
                    Textarea::make('observacion')
                        ->label('Observacion')
                        ->disableAutocomplete()
                        ->columnSpan(6)
                        ->rows(6),
                    
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
                        ,
                    */

                    Toggle::make('vigente')
                        ->label('Empresa Vigente/No vigente')
                        ->required()
                        ->columnSpan('full')
                        ->default(true)
                        ->onIcon('heroicon-o-check')
                        ->offIcon('heroicon-o-x-mark')
                        ->onColor('success')
                        ->offColor('danger'),
           //     ])
           ]);
        }

    public static function table(Table $table): Table
    {
        return $table
        ->defaultSort('razonsocial', 'asc')
        ->columns([
            TextColumn::make('razonsocial')
                ->label('Razón social')
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
                Tables\Actions\CreateAction::make()->closeModalByClickingAway(false),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmpresas::route('/'),
        ];
    }    
}
