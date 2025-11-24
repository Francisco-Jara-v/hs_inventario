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
                ->label('Descargar contrato PDF')
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

    protected function getContent(): string
    {
        $pdfPath = $this->record->ruta_contrato_pdf;

        if (! $pdfPath || ! Storage::exists($pdfPath)) {
            return "<div class='text-center text-gray-500 py-10'>📄 No hay contrato PDF disponible.</div>";
        }

        $pdfUrl = Storage::url($pdfPath);

        // 📄 Mostrar el PDF incrustado
        return <<<HTML
            <div class="flex justify-center p-4">
                <iframe 
                    src="{$pdfUrl}" 
                    width="100%" 
                    height="800px" 
                    style="border: none; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                </iframe>
            </div>
        HTML;
    }
}
