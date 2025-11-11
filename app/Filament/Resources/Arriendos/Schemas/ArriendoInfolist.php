<?php

namespace App\Filament\Resources\Arriendos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Models\Equipo;

class ArriendoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('Equipo_id')
                    ->label('Tipo de equipo')
                    ->options(Equipo::all()->pluck('Nombre_equipos', 'ID_Equipos')->toArray())
                    ->required(),

                TextInput::make('Equipo_detalle_id')
                    ->label('Nombre específico')
                    ->required(),

                Select::make('Estado')
                    ->options([
                        'En stock' => 'En stock',
                        'En arriendo' => 'En arriendo',
                        'En reparación' => 'En reparación',
                        'Fuera de servicio' => 'Fuera de servicio',
                    ])
                    ->default('En arriendo')
                    ->required(),

                TextInput::make('Precio_equipo')
                    ->numeric()
                    ->required(),

                TextInput::make('Garantia')
                    ->numeric(),
            ]);
    }
}
