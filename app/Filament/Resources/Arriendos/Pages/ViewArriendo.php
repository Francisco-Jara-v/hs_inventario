<?php

namespace App\Filament\Resources\Arriendos\Pages;

use App\Filament\Resources\Arriendos\ArriendoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArriendo extends ViewRecord
{
    protected static string $resource = ArriendoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
