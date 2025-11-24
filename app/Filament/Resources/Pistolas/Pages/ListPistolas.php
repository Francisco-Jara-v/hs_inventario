<?php

namespace App\Filament\Resources\Pistolas\Pages;

use App\Filament\Resources\Pistolas\PistolasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPistolas extends ListRecords
{
    protected static string $resource = PistolasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
