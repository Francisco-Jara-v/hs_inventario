<?php

namespace App\Filament\Resources\Mangueras\Pages;

use App\Filament\Resources\Mangueras\ManguerasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMangueras extends ListRecords
{
    protected static string $resource = ManguerasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
