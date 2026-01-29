<?php

namespace App\Filament\Resources\Mangueras\Pages;

use App\Filament\Resources\Mangueras\ManguerasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMangueras extends EditRecord
{
    protected static string $resource = ManguerasResource::class;
        //FUNCION PARA REDIRECCIONAR AL INDEX DEL MODULO
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
