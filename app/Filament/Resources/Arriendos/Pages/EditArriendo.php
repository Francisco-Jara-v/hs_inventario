<?php

namespace App\Filament\Resources\Arriendos\Pages;

use App\Filament\Resources\Arriendos\ArriendoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditArriendo extends EditRecord
{
    protected static string $resource = ArriendoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
