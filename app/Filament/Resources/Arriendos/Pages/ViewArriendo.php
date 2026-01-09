<?php

namespace App\Filament\Resources\Arriendos\Pages;

use App\Filament\Resources\Arriendos\ArriendoResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class ViewArriendo extends ViewRecord
{
    protected static string $resource = ArriendoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('descargar_pdf')
                ->label('Ver PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->url(fn() => $this->getRecord()->ruta_contrato_pdf
                    ? Storage::url($this->getRecord()->ruta_contrato_pdf)
                    : null,
                true)
                ->openUrlInNewTab()
                ->visible(fn() => $this->getRecord()->ruta_contrato_pdf !== null),
        ];
    }


}
