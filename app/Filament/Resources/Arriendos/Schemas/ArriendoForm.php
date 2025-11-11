<?php

namespace App\Filament\Resources\Arriendos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\Cliente;

class ArriendoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('ID_Clientes')
                    ->label('Cliente')
                    ->options(function () {
                        // Traemos los clientes y evitamos labels nulos
                        return Cliente::all()
                            ->mapWithKeys(function ($cliente) {
                                // Si 'Empresa' es nulo, mostramos el nombre o un texto genérico
                                $label = $cliente->Empresa ?? 'Cliente #' . $cliente->ID_Clientes;
                                return [$cliente->ID_Clientes => $label];
                            })
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),

                DatePicker::make('Fecha_inicio')
                    ->required(),

                DatePicker::make('Fecha_fin'),

                TextInput::make('Guia_Despacho')
                    ->label('Guía de despacho'),

                TextInput::make('Precio_total')
                    ->numeric()
                    ->required(),

                Select::make('Estado')
                    ->options([
                        'Activo' => 'Activo',
                        'Finalizado' => 'Finalizado',
                        'Cancelado' => 'Cancelado',
                    ])
                    ->default('Activo')
                    ->required(),

                Textarea::make('Observaciones'),
            ]);
    }
}
