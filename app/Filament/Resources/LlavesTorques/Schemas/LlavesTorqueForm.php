<?php

namespace App\Filament\Resources\LlavesTorques\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;



class LlavesTorqueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('Id_Equipo')
                ->default(6), // siempre asigna 1
                TextInput::make('Equipo')
                    ->required(),
                TextInput::make('Marca')
                    ->default(null),
                TextInput::make('Modelo')
                    ->default(null),
                TextInput::make('Serie')
                    ->default(null),
                TextInput::make('Codigo')
                    ->default(null),
                TextInput::make('Cuadrante')
                    ->default(null),
                TextInput::make('Torque')
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
