<?php

namespace App\Filament\Resources\Cabezales\Pages;

use App\Filament\Resources\Cabezales\CabezalesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCabezales extends ListRecords
{
    protected static string $resource = CabezalesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
