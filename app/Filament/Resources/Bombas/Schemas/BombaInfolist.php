<?php

namespace App\Filament\Resources\Bombas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BombaInfolist
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
                TextEntry::make('Serie'),
                TextEntry::make('Codigo'),
                TextEntry::make('Precio')
                    ->numeric(),
                TextEntry::make('Garantia')
                    ->numeric(),
                TextEntry::make('Estado'),
            ]);
    }
}
