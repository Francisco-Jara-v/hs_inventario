<?php

namespace App\Filament\Resources\Pistolas\Pages;

use App\Filament\Resources\Pistolas\PistolasResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPistolas extends ViewRecord
{
    protected static string $resource = PistolasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
