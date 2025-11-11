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
                Select::make('ID_Cliente')
                    ->label('Cliente')
                    ->options(Cliente::all()->pluck('Empresa', 'Id_Clientes')->toArray())
                    ->searchable()
                    ->required(),

                DatePicker::make('Fecha_inicio')
                    ->required(),

                DatePicker::make('Fecha_fin')
                    ,

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
