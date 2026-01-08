<?php

namespace App\Filament\Resources\Arriendos\Pages;

use App\Filament\Resources\Arriendos\ArriendoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArriendos extends ListRecords
{
    protected static string $resource = ArriendoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Nuevo Arriendo')
            ->modalHeading('Nuevo Arriendo')
            ->modalWidth('7xl') // importante para formularios grandes
            ->createAnother(false),
        ];
    }
}
