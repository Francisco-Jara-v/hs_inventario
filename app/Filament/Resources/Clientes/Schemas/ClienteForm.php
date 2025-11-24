<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Empresa')
                    ->required(),
                TextInput::make('Rut')
                    ->required(),
                TextInput::make('Telefono')
                    ->default(null),
                TextInput::make('Correo')
                    ->default(null),
                TextInput::make('Direccion')
                    ->default(null),
                TextInput::make('Ciudad')
                    ->default(null),
            ]);
    }
}
