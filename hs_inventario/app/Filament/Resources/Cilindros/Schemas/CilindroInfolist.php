<?php

namespace App\Filament\Resources\Cilindros\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CilindroInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id_Equipo')
                    ->numeric(),
                TextEntry::make('Equipo'),
                TextEntry::make('Marca'),
                TextEntry::make('Modelo'),
                TextEntry::make('Accion'),
                TextEntry::make('Toneladas')
                    ->numeric(),
                TextEntry::make('Altura'),
                TextEntry::make('Carrera'),
                TextEntry::make('Precio')
                    ->numeric(),
                TextEntry::make('Garantia')
                    ->numeric(),
                TextEntry::make('Estado'),
            ]);
    }
}
