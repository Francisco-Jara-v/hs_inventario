<?php

namespace App\Filament\Resources\Pistolas\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PistolasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('Id_Equipo')
                ->default(5), // siempre asigna 1
                TextInput::make('Equipo')
                    ->required(),
                TextInput::make('Descripcion')
                    ->default(null),
                TextInput::make('Marca')
                    ->default(null),
                TextInput::make('Modelo')
                    ->default(null),
                TextInput::make('Serie')
                    ->default(null),
                TextInput::make('Codigo')
                    ->default(null),
                TextInput::make('Observacion')
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
