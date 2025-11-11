<?php

namespace App\Filament\Resources\Arriendos;

use App\Filament\Resources\Arriendos\Pages\CreateArriendo;
use App\Filament\Resources\Arriendos\Pages\EditArriendo;
use App\Filament\Resources\Arriendos\Pages\ListArriendos;
use App\Filament\Resources\Arriendos\Pages\ViewArriendo;
use App\Filament\Resources\Arriendos\Schemas\ArriendoInfolist;
use App\Filament\Resources\Arriendos\Tables\ArriendosTable;
use App\Models\Arriendo;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\Dado;
use App\Models\Bomba;
use App\Models\Cilindro;
use App\Models\Cabezal;
use App\Models\Pistola;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Repeater;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;


class ArriendoResource extends Resource
{
    protected static ?string $model = Arriendo::class;

    // 🔧 corregido el tipo del icono
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboard;

    protected static ?string $recordTitleAttribute = 'Contrato';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                Section::make('Datos del cliente')->schema([
                    Select::make('ID_Cliente')
                        ->label('Cliente')
                        ->options(Cliente::pluck('Empresa', 'ID_Clientes'))
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
                ])->columnSpan(1),

                Section::make('Detalle del contrato')->schema([
                    DatePicker::make('Fecha_inicio')->label('Inicio')->required(),
                    DatePicker::make('Fecha_fin')->label('Término')->default(now()),
                    TextInput::make('Guia_Despacho')->required(),
                    Select::make('Estado')
                        ->options([
                            'En curso' => 'En curso',
                            'Finalizado' => 'Finalizado',
                            'Cancelado' => 'Cancelado',
                        ])
                        ->required(),
                ])->columnSpan(1),
            ]),

            Section::make('Observaciones')->schema([
                Textarea::make('Observaciones')->rows(3),
            ])->collapsible(),

            Section::make('Equipos arrendados')->schema([
                Repeater::make('detalles')
                ->relationship('detalles')
                ->schema([
                    Select::make('Equipo_id')
                        ->label('Tipo de equipo')
                        ->options(Equipo::pluck('Nombre_equipos', 'ID_Equipos'))
                        ->reactive(),
                
                    Select::make('Equipo_detalle_id')
                        ->label('Equipo')
                        ->options(function (callable $get) {
                            $tipoId = $get('Equipo_id');
                            if (! $tipoId) return [];
                        
                            $tipo = Equipo::find($tipoId);
                            if (! $tipo) return [];
                        
                            $nombre = mb_strtolower($tipo->Nombre_equipos);
                        
                            // Función para construir las opciones [id => etiqueta]
                            $map = fn($items, $fn) => $items->mapWithKeys(fn($i) => [$i->id => $fn($i)])->toArray();
                        
                            if (str_contains($nombre, 'bomba')) {
                                return $map(Bomba::where('Estado', 'En stock')->get(),
                                    fn($i) => "{$i->Equipo} {$i->Modelo} - COD {$i->Codigo}");
                            }
                            if (str_contains($nombre, 'cabezal')) {
                                return $map(Cabezal::where('Estado', 'En stock')->get(),
                                    fn($i) => "{$i->Equipo} {$i->Modelo} - COD {$i->Codigo}");
                            }
                            if (str_contains($nombre, 'cilindro')) {
                                return $map(Cilindro::where('Estado', 'En stock')->get(),
                                    fn($i) => "{$i->Equipo} {$i->Modelo} - COD {$i->Codigo}");
                            }
                            if (str_contains($nombre, 'pistola')) {
                                return $map(Pistola::where('Estado', 'En stock')->get(),
                                    fn($i) => "{$i->Equipo} {$i->Modelo} - COD {$i->Codigo}");
                            }
                            if (str_contains($nombre, 'dado')) {
                                return $map(Dado::where('Cantidad_disponible', '>', 0)->get(),
                                    fn($i) => "{$i->Equipo} {$i->Medida} Cuad {$i->Cuadrante}");
                            }
                        
                            return [];
                        })
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $set, callable $get) {
                            $tipo = Equipo::find($get('Equipo_id'));
                            if (! $tipo) return;
                        
                            $nombre = mb_strtolower($tipo->Nombre_equipos);
                        
                            $modelo = match (true) {
                                str_contains($nombre, 'bomba') => Bomba::find($state),
                                str_contains($nombre, 'cabezal') => Cabezal::find($state),
                                str_contains($nombre, 'cilindro') => Cilindro::find($state),
                                str_contains($nombre, 'pistola') => Pistola::find($state),
                                str_contains($nombre, 'dado') => Dado::find($state),
                                default => null,
                            };
                        
                            if ($modelo) {
                                $set('Precio_equipo', $modelo->Precio ?? 0);
                                $set('Garantia', $modelo->Garantia ?? 0);
                            }
                        }),
                    
                    TextInput::make('Precio_equipo')
                        ->label('Precio')
                        ->prefix('$')
                        ->numeric()
                        ->readOnly(),
                    
                    TextInput::make('Garantia')
                        ->label('Garantía')
                        ->prefix('$')
                        ->numeric()
                        ->readOnly(),
                ])
                ->afterStateUpdated(function ($state, $set) {
                            // $state es un array de filas del repeater
                            $total = collect($state)->sum(fn($r) => floatval($r['Precio_equipo'] ?? 0));
                            $set('Precio_total', $total);
                        })
                ->addActionLabel('Agregar equipo'),
                        ])
                        ->extraAttributes(['class' => 'bg-blue-50 rounded-xl shadow-sm p-4 border border-blue-100'])
                ->collapsible(),

            // Total abajo (fuera del repeater)
            Section::make('Total')
                ->schema([
                    TextInput::make('Precio_total')
                        ->label('Total del arriendo')
                        ->prefix('$')
                        ->numeric()
                        ->readOnly(),
                ])
                ->extraAttributes(['class' => 'bg-blue-100 rounded-xl shadow-sm p-4 border border-blue-200']),
        
                    ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ArriendoInfolist::configure($schema);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return ArriendosTable::configure($table);
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
