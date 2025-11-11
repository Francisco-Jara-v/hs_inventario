<?php

namespace App\Filament\Resources\Cabezales\Pages;

use App\Filament\Resources\Cabezales\CabezalesResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCabezales extends ViewRecord
{
    protected static string $resource = CabezalesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
