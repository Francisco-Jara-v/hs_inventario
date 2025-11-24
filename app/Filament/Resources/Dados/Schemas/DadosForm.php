<?php

namespace App\Filament\Resources\Dados\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DadosForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                Hidden::make('Id_Equipo')
                ->default(4), // siempre asigna 4
                TextInput::make('Equipo')
                    ->required(),
                TextInput::make('Medida')
                    ->default(null),
                TextInput::make('Cuadrante')
                    ->default(null),
                TextInput::make('Cantidad_disponible')
                    ->default(null),
                TextInput::make('Precio')
                    ->required()
                    ->numeric(),
                TextInput::make('Garantia')
                    ->required()
                    ->numeric(),
            ]);
    }
}
