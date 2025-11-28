<?php

namespace App\Filament\Resources\FacturaCompras\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Forms\Components\Repeater;
use function Laravel\Prompts\textarea;

class FacturaCompraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                //Sección con detalles del Proveedor
                Section::make('Detalles del proveedor')
                ->schema([
                    TextInput::make('proveedor_nombre')
                        ->label('Nombre del Proveedor')
                        ->required(),

                    TextInput::make('proveedor_rut')
                        ->label('RUT')
                        ->nullable(),

                    TextInput::make('proveedor_giro')
                        ->label('Giro')
                        ->nullable(),
                ])
                ->columns(2),

                //Sección con informacion del Documento
                Section::make('Informacion del documento')
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
                        ->required(),
                    TextInput::make('folio')
                        ->numeric()
                        ->label('Folio'),
                    DatePicker::make('fecha_emision')
                        ->label('Fecha de Emisión')
                        ->required(),
                    DatePicker::make('fecha_recepcion')
                        ->label('Fecha de Recepción')
                        ->nullable(),
                    DatePicker::make('fecha_vencimiento')
                        ->label('Fecha de Vencimiento')
                        ->nullable(),
                    ])
                ->columns(2),

                //Sección con detalles de la factura
                Section::make('Detalle de Factura')
    ->schema([
        Repeater::make('detalles')
    ->label('Líneas de Detalle')
    ->relationship()
    ->live()
    ->schema([
        TextInput::make('descripcion')
            ->label('Descripción')
            ->required(),

        TextInput::make('cantidad')
            ->numeric()
            ->default(1)
            ->reactive()
            ->afterStateUpdated(function ($state, $set, $get) {
                $set('subtotal', ($state * $get('precio_unitario')) - $get('descuento'));
            })
            ->required(),

        TextInput::make('precio_unitario')
            ->numeric()
            ->default(0)
            ->reactive()
            ->afterStateUpdated(function ($state, $set, $get) {
                $set('subtotal', ($get('cantidad') * $state) - $get('descuento'));
            })
            ->required(),

        TextInput::make('descuento')
            ->numeric()
            ->default(0)
            ->reactive()
            ->afterStateUpdated(function ($state, $set, $get) {
                $set('subtotal', ($get('cantidad') * $get('precio_unitario')) - $state);
            }),

        TextInput::make('subtotal')
            ->numeric()
            ->default(0)
            ->disabled()        // ← evita que el usuario lo cambie
            ->dehydrated()      // ← sí lo guardamos en BD
            ->required(),
    ])
    ->columns(2)
    ->reactive()
    ->afterStateUpdated(function ($state, $set) {
        // Recalcular totales generales
        $neto = 0;

        foreach ($state as $item) {
            $neto += $item['subtotal'] ?? 0;
        }

        $set('neto', $neto);
        $set('iva', $neto * 0.19);
        $set('total', ($neto * 1.19) + ($state['exento'] ?? 0));
    })
    ->defaultItems(1)
    ->reorderable()
    ->collapsible(),]),

Section::make('Montos Totales')
->schema([
    TextInput::make('neto')
        ->numeric()
        ->required()
        ->disabled()
        ->dehydrated(),

    TextInput::make('iva')
        ->numeric()
        ->required()
        ->disabled()
        ->dehydrated(),

    TextInput::make('exento')
        ->numeric()
        ->default(0)
        ->reactive()
        ->afterStateUpdated(function ($state, $set, $get) {
            $set('total', $get('neto') + $get('iva') + $state);
        }),

    TextInput::make('total')
        ->numeric()
        ->required()
        ->disabled()
        ->dehydrated(),
])
->columns(4),

                Section::make('')
                ->schema([
                    Textarea::make('observaciones')
                ])

            ])
            
            ->Columns(1);
    }
}
