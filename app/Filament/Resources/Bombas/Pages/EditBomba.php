<?php

namespace App\Filament\Resources\Bombas\Pages;

use App\Filament\Resources\Bombas\BombaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBomba extends EditRecord
{
    protected static string $resource = BombaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
