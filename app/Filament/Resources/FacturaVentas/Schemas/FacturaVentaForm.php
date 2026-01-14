<?php

namespace App\Filament\Resources\FacturaVentas\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\{
    Select,
    TextInput,
    DatePicker,
    Repeater,
    Textarea,
    CheckBox
};
use Filament\Forms\Get;
use App\Models\Cliente;
use App\Models\FacturaVenta;

class FacturaVentaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /* ===============================
                 * DETALLES DEL CLIENTE
                 * =============================== */
                Section::make('Detalles del Cliente')
                    ->schema([
                        Select::make('cliente_id')
                            ->label('Cliente')
                            ->options(Cliente::pluck('Empresa', 'ID_Clientes'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $cliente = Cliente::find($state);

                                if ($cliente) {
                                    $set('Rut', $cliente->Rut);
                                    $set('Giro', $cliente->Giro);
                                    $set('Direccion', $cliente->Direccion);
                                }
                            }),

                        TextInput::make('Rut')->disabled(),
                        TextInput::make('Giro')->disabled(),
                        TextInput::make('Direccion')->disabled(),
                    ])
                    ->columns(2),

                /* ===============================
                 * INFORMACIÓN DEL DOCUMENTO
                 * =============================== */
                Section::make('Información del Documento')
                    ->schema([
                        Select::make('tipo_documento')
                            ->label('Tipo de documento')
                            ->options([
                                'DECLARACION DE INGRESO' => 'DECLARACION DE INGRESO',
                                'FACTURA' => 'FACTURA',
                                'FACTURA ELECTRONICA' => 'FACTURA ELECTRONICA',
                                'FACTURA DE COMPRA' => 'FACTURA DE COMPRA',
                                'FACTURA DE COMPRA ELECTRONICA' => 'FACTURA DE COMPRA ELECTRONICA',
                                'FACTURA DE INICIO' => 'FACTURA DE INICIO',
                                'FACTURA EXENTA' => 'FACTURA EXENTA',
                                'FACTURA ELECTRONICA EXENTA' => 'FACTURA ELECTRONICA EXENTA',
                                'LIQUIDACION FACTURA' => 'LIQUIDACION FACTURA',
                                'LIQUIDACION FACTURA EXENTA' => 'LIQUIDACION FACTURA EXENTA',
                                'NOTA DE CREDITO' => 'NOTA DE CREDITO',
                                'NOTA DE CREDITO ELECTRONICA' => 'NOTA DE CREDITO ELECTRONICA',
                                'NOTA DE DEBITO' => 'NOTA DE DEBITO',
                                'NOTA DE DEBITO ELECTRONICA' => 'NOTA DE DEBITO ELECTRONICA',
                                'SOLICITUD REGISTRO FACTURA' => 'SOLICITUD REGISTRO FACTURA',
                            ])
                            ->searchable()
                            ->required()
                            ->reactive(),

                        TextInput::make('folio')
                            ->numeric()
                            ->required()
                            ->label('Folio'),

                        DatePicker::make('fecha_emision')
                            ->required(),

                        DatePicker::make('fecha_vencimiento'),
                    ])
                    ->columns(2),

                /* ===============================
                 * FACTURA DE REFERENCIA (NCE)
                 * =============================== */
                Select::make('factura_referencia_id')
                    ->label('Factura anulada de referencia')
                    ->options(
                        FacturaVenta::query()
                            ->where('estado', 'ANULADA')
                            ->whereIn('tipo_documento', [
                                'FACTURA',
                                'FACTURA ELECTRONICA',
                                'FACTURA EXENTA',
                                'FACTURA ELECTRONICA EXENTA',
                            ])
                            ->whereDoesntHave('notasCredito')
                            ->with('cliente')
                            ->get()
                            ->mapWithKeys(fn ($factura) => [
                                $factura->id =>
                                    'Folio ' . $factura->folio . ' – ' . ($factura->cliente->Empresa ?? ''),
                            ])
                    )
                    ->searchable()
                    ->reactive()
                    ->visible(fn ($get) =>
                        $get('tipo_documento') === 'NOTA DE CREDITO ELECTRONICA' ||
                        $get('tipo_documento') === 'NOTA DE CREDITO'
                    )
                    ->afterStateUpdated(function ($state, callable $set) {

                        if (!$state) return;

                        $factura = FacturaVenta::with('detalles')->find($state);
                        if (!$factura) return;

                        // Cliente
                        $set('cliente_id', $factura->cliente_id);

                        // Totales
                        $set('neto', $factura->neto);
                        $set('iva', $factura->iva);
                        $set('total', $factura->total);

                        // Detalles
                        $set('detalles', $factura->detalles->map(fn ($d) => [
                            'descripcion' => $d->descripcion,
                            'cantidad' => $d->cantidad,
                            'precio_unitario' => $d->precio_unitario,
                            'descuento' => $d->descuento,
                            'subtotal' => $d->subtotal,
                        ])->toArray());
                    }),

                /* ===============================
                 * DETALLE DE FACTURA
                 * =============================== */
                Section::make('Detalle de Factura')
                    ->schema([
                        Repeater::make('detalles')
                            ->relationship()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                $neto = collect($state)->sum(fn ($i) =>
                                    (float) ($i['subtotal'] ?? 0)
                                );

                                $iva = $neto * 0.19;
                                $total = $neto + $iva;

                                $set('../../neto', round($neto));
                                $set('../../iva', round($iva));
                                $set('../../total', round($neto + $iva));
                            })
                            ->schema([
                                TextInput::make('descripcion')
                                ->required(),
                                Checkbox::make('tiene_detalle')
                                ->label('Agregar línea de detalle')
                                ->inline(false)
                                //->reactive()
                                ->dehydrated(false)
                                    ->afterStateHydrated(function ($state, $set, $get) {
                                        if (filled($get('detalle'))) {
                                            $set('tiene_detalle', true);
                                        }
                                    }),
                                TextInput::make('cantidad')
                                    ->numeric()
                                    ->default(1)
                                    ->lazy()
                                    ->afterStateUpdated(fn ($state, $set, $get) =>
                                        $set('subtotal', $state * ($get('precio_unitario') ?? 0))
                                    ),

                                TextInput::make('precio_unitario')
                                    ->numeric()
                                    ->lazy()
                                    ->afterStateUpdated(fn ($state, $set, $get) =>
                                        $set('subtotal', ($get('cantidad') ?? 1) * $state)
                                    ),

                                TextInput::make('subtotal')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(),
                                Textarea::make('detalle')
                                ->label('Detalle')
                                ->visible(fn ($get) =>
                                    $get('tiene_detalle') === true
                                )
                                ->columnSpanFull()
                                ->dehydrated(fn ($get) => filled($get('detalle')))
                            ])
                            ->columns(5)
                            ->defaultItems(1)
                            ->addAction(function (callable $set, callable $get) {
                                    $neto = collect($get('detalles'))->sum(fn ($item) =>
                                        (float) ($item['subtotal'] ?? 0)

                                    );
                                    $set('neto', round($neto));
                                    $iva = $neto * 0.19;
                                    $total = $neto + $iva;          
                                    $set('iva', round($iva));
                                    $set('total', round($total));
                                })]),

                /* ===============================
                 * TOTALES
                 * =============================== */
                Section::make('Montos Totales')
                    ->schema([
                        TextInput::make('neto')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                        TextInput::make('iva')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                        TextInput::make('total')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->columns(3),

                /* ===============================
                 * OBSERVACIONES
                 * =============================== */
                Section::make()
                    ->schema([
                        Textarea::make('observaciones'),
                    ]),
            ])
            ->columns(1);
    }
}
