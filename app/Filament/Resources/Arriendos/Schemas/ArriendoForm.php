<?php

namespace App\Filament\Resources\Arriendos\Schemas;

use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\Dado;
use App\Models\Bomba;
use App\Models\Cilindro;
use App\Models\Cabezal;
use App\Models\Pistola;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Carbon\Carbon;

class ArriendoForm
{
    /** 🔹 Calcula el total automáticamente */
    public static function calcularTotalDatos(array $detalles, string $fechaInicio, string $fechaFin): float
{
    $inicio = Carbon::parse($fechaInicio);
    $fin = Carbon::parse($fechaFin);
    $horas = $inicio->diffInHours($fin);
    $dias = max(1, ceil($horas / 24));

    $totalEquipos = collect($detalles)->sum(fn($r) => floatval($r['Precio_equipo'] ?? 0));
    return $totalEquipos * $dias;
}
    public static function calcularTotal(callable $get, callable $set): void
    {
        $detalles = $get('detalles') ?? [];
        $fechaInicio = $get('Fecha_inicio');
        $fechaFin = $get('Fecha_fin');

        if (! $fechaInicio || ! $fechaFin) {
            $set('Precio_total', 0);
            return;
        }

        $inicio = Carbon::parse($fechaInicio);
        $fin = Carbon::parse($fechaFin);
        $horas = $inicio->diffInHours($fin);
        $dias = max(1, ceil($horas / 24));

        $totalEquipos = collect($detalles)->sum(fn($d) => floatval($d['Precio_equipo'] ?? 0));

        $set('Precio_total', $totalEquipos * $dias);
        
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([

                // 🟦 DATOS DEL CLIENTE
                Section::make('Datos del cliente')->schema([
                    Select::make('ID_Cliente')
                        ->label('Cliente')
                        ->options(Cliente::pluck('Empresa', 'ID_Clientes'))
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state, $set) {
                            $cliente = Cliente::find($state);
                            if ($cliente) {
                                $set('Rut', $cliente->Rut);
                                $set('Ciudad', $cliente->Ciudad ?? '');
                                $set('Direccion', $cliente->Direccion ?? '');
                            }
                        }),
                    TextInput::make('Rut')->disabled(),
                    TextInput::make('Direccion')->disabled(),
                    TextInput::make('Ciudad')->disabled(),
                ])->columnSpan(1),

                // 🟩 DETALLE CONTRATO
                Section::make('Detalle del contrato')->schema([
                    DateTimePicker::make('Fecha_inicio')
                        ->label('Inicio')
                        ->default(now())
                        ->reactive()
                        ->afterStateUpdated(fn($state, $set, $get) => self::calcularTotal($get, $set))
                        ->required(),

                    DateTimePicker::make('Fecha_fin')
                        ->label('Término')
                        ->default(now())
                        ->reactive()
                        ->afterStateUpdated(fn($state, $set, $get) => self::calcularTotal($get, $set))
                        ->required(),

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

            // 🟨 OBSERVACIONES
            Section::make('Observaciones')->schema([
                Textarea::make('Observaciones')->rows(3),
            ])->collapsible(),

            // 🟥 EQUIPOS ARRENDADOS
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
                                if (!$tipoId) return [];

                                $tipo = Equipo::find($tipoId);
                                if (!$tipo) return [];

                                $nombre = mb_strtolower($tipo->Nombre_equipos);

                                $map = fn($items, $fn) => $items->mapWithKeys(fn($i) => [$i->id => $fn($i)])->toArray();

                                return match (true) {
                                    str_contains($nombre, 'bomba') => $map(Bomba::where('Estado', 'En stock')->get(), fn($i) => "{$i->Equipo} {$i->Modelo} - COD {$i->Codigo}"),
                                    str_contains($nombre, 'cabezal') => $map(Cabezal::where('Estado', 'En stock')->get(), fn($i) => "{$i->Equipo} {$i->Modelo} - COD {$i->Codigo}"),
                                    str_contains($nombre, 'cilindro') => $map(Cilindro::where('Estado', 'En stock')->get(), fn($i) => "{$i->Equipo} {$i->Modelo} - COD {$i->Codigo}"),
                                    str_contains($nombre, 'pistola') => $map(Pistola::where('Estado', 'En stock')->get(), fn($i) => "{$i->Equipo} {$i->Modelo} - COD {$i->Codigo}"),
                                    str_contains($nombre, 'dado') => $map(Dado::where('Cantidad_disponible', '>', 0)->get(), fn($i) => "{$i->Equipo} {$i->Medida} Cuad {$i->Cuadrante}"),
                                    default => [],
                                };
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
                                } else {
                                    $set('Precio_equipo', 0);
                                    $set('Garantia', 0);
                                }

                                // 🧮 recalcular total al instante
                                self::calcularTotal($get, $set);
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
                    ->afterStateUpdated(fn($state, $set, $get) => self::calcularTotal($get, $set))
                    ->addActionLabel('Agregar equipo'),
            ])
            ->extraAttributes(['class' => 'bg-blue-50 rounded-xl shadow-sm p-4 border border-blue-100'])
            ->collapsible(),

            // 🟦 TOTAL FINAL
            Section::make('Total')->schema([
                TextInput::make('Precio_total')
                    ->label('Total del arriendo')
                    ->prefix('$')
                    ->numeric()
                    ->readOnly(),
            ])
            ->extraAttributes(['class' => 'bg-blue-100 rounded-xl shadow-sm p-4 border border-blue-200']),
        ]);
    }
}
