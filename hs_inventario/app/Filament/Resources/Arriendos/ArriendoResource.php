<?php

namespace App\Filament\Resources\Arriendos;

use App\Filament\Resources\Arriendos\Pages\CreateArriendo;
use App\Filament\Resources\Arriendos\Pages\EditArriendo;
use App\Filament\Resources\Arriendos\Pages\ListArriendos;
use App\Filament\Resources\Arriendos\Pages\ViewArriendo;
use App\Filament\Resources\Arriendos\Schemas\ArriendoForm;
use App\Filament\Resources\Arriendos\Schemas\ArriendoInfolist;
use App\Filament\Resources\Arriendos\Tables\ArriendosTable;
use App\Models\Arriendo;
use App\Models\Cliente;
use App\Models\Equipo;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArriendoResource extends Resource
{
    protected static ?string $model = Arriendo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Contrato';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // Datos del cliente
            Select::make('ID_Cliente')
                ->label('Cliente')
                ->options(Cliente::all()->pluck('Nombre', 'Id_Clientes'))
                ->reactive()
                ->afterStateUpdated(function ($state, $set) {
                    $cliente = Cliente::find($state);
                    if ($cliente) {
                        $set('Direccion', $cliente->Direccion);
                        $set('Ciudad', $cliente->Ciudad ?? '');
                    }
                }),
            TextInput::make('Direccion')->disabled(),
            TextInput::make('Ciudad')->disabled(),

            // Datos del arriendo
            DatePicker::make('Fecha_inicio')->required(),
            DatePicker::make('Fecha_fin')->required(),
            TextInput::make('Guia_Despacho')->required(),
            TextInput::make('Precio_total')->numeric()->required(),
            Select::make('Estado')->options([
                'En proceso' => 'En proceso',
                'Finalizado' => 'Finalizado',
                'Cancelado' => 'Cancelado',
            ])->required(),
            Textarea::make('Observaciones'),

            // Detalles de equipos
            Repeater::make('detalles')
                ->relationship('detalles')
                ->schema([
                    Select::make('Equipo_tipo')
                        ->label('Tipo de equipo')
                        ->options(fn() => Equipo::pluck('Nombre_equipos', 'ID_Equipos')
                            ->map(fn($nombre, $id) => [$id => $nombre ?? 'Sin nombre'])
                            ->collapse()
                            ->toArray())
                        ->reactive()
                        ->afterStateUpdated(function ($state, $set) {
                            $equipos = Equipo::where('ID_Equipos', $state)
                                ->pluck('Nombre_equipos', 'ID_Equipos')
                                ->map(fn($item, $key) => [$key => (string)$item])
                                ->collapse()
                                ->toArray();

                            $set('Equipo_id_options', $equipos);
                        }),

                    Select::make('Equipo_id')
                        ->label('Equipo')
                        ->options(function ($get) {
                            $options = $get('Equipo_id_options') ?? [];
                            return array_map(fn($item) => (string)$item, $options);
                        })
                        ->required(),

                    TextInput::make('Precio_equipo')->numeric()->required(),
                    TextInput::make('Garantia')->numeric()->required(),
                    Select::make('Estado')->options([
                        'En stock' => 'En stock',
                        'En arriendo' => 'En arriendo',
                        'En reparacion' => 'En reparacion',
                    ])->default('En stock'),
                ])
                ->addActionLabel('Agregar equipo'),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ArriendoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArriendosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArriendos::route('/'),
            'create' => CreateArriendo::route('/create'),
            'view' => ViewArriendo::route('/{record}'),
            'edit' => EditArriendo::route('/{record}/edit'),
        ];
    }
}
