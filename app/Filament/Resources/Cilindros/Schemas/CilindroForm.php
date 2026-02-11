<?php

namespace App\Filament\Resources\Cilindros\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class CilindroForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('Id_Equipo')
                ->default(2),
                TextInput::make('Equipo')
                    ->required(),
                TextInput::make('Marca')
                    ->default(null),
                TextInput::make('Modelo')
                    ->default(null),
                Select::make('Accion')
                    ->options(['Simple' => 'Simple', 'Doble' => 'Doble'])
                    ->default(null),
                TextInput::make('Toneladas')
                    ->numeric()
                    ->default(null),
                TextInput::make('Altura')
                    ->default(null),
                TextInput::make('Carrera')
                    ->default(null),
                TextInput::make('Codigo')
                    ->default(null),
                TextInput::make('Precio')
                    ->required()
                    ->numeric(),
                TextInput::make('Garantia')
                    ->required()
                    ->numeric(),
                Select::make('Estado')
                    ->options([
            'En stock' => 'En stock',
            'En arriendo' => 'En arriendo',
            'En reparacion' => 'En reparacion',
            'Fuera de servicio' => 'Fuera de servicio',
        ])
                    ->default('En stock')
                    ->required(),
            ]);
    }
}
