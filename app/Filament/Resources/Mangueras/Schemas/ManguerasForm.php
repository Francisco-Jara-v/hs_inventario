<?php

namespace App\Filament\Resources\Mangueras\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ManguerasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Hidden::make('Id_Equipo')
                ->default(7), 
                TextInput::make('Equipo')
                    ->required(),
                TextInput::make('Observacion')
                    ->default(null),
                TextInput::make('Cantidad_disponible')
                    ->default(null),
                TextInput::make('Cantidad_arriendo')
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
