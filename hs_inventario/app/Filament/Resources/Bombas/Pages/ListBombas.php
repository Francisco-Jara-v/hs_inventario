<?php

namespace App\Filament\Resources\Bombas\Pages;

use App\Filament\Resources\Bombas\BombaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBombas extends ListRecords
{
    protected static string $resource = BombaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
