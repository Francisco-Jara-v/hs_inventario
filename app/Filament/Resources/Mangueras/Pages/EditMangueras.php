<?php

namespace App\Filament\Resources\Mangueras\Pages;

use App\Filament\Resources\Mangueras\ManguerasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMangueras extends EditRecord
{
    protected static string $resource = ManguerasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
