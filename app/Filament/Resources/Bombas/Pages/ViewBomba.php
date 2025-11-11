<?php

namespace App\Filament\Resources\Bombas\Pages;

use App\Filament\Resources\Bombas\BombaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBomba extends ViewRecord
{
    protected static string $resource = BombaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
