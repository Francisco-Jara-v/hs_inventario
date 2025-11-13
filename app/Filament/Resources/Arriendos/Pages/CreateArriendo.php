<?php

namespace App\Filament\Resources\Arriendos\Pages;

use App\Filament\Resources\Arriendos\ArriendoResource;
use App\Models\Arriendo;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;

class CreateArriendo extends CreateRecord
{
    protected static string $resource = ArriendoResource::class;

    protected function afterCreate(): void
    {
        $arriendo = $this->record; // Registro recién creado
        $cliente = $arriendo->cliente;

        // 📂 Rutas de archivos
        $templatePath = storage_path('app/public/Plantilla contrato.docx');
        $outputDir = storage_path('app/public/contratos');
        $outputDocx = "{$outputDir}/contrato_{$arriendo->Contrato}.docx";
        $outputPdf = "{$outputDir}/contrato_{$arriendo->Contrato}.pdf";

        // Crear carpeta si no existe
        Storage::makeDirectory('public/contratos');

        // Cargar plantilla
        $template = new TemplateProcessor($templatePath);

        // 🧾 Reemplazar datos del cliente y contrato
        $template->setValue('empresa', $cliente->Empresa ?? '');
        $template->setValue('rut_empresa', $cliente->Rut ?? '');
        $template->setValue('direccion_empresa', $cliente->Direccion ?? '');
        $template->setValue('ciudad_empresa', $cliente->Ciudad ?? '');
        $template->setValue('guia_despacho', $arriendo->Guia_Despacho ?? '');
        $template->setValue('contrato', $arriendo->Contrato ?? '');
        $template->setValue('fecha_inicio', Carbon::parse($arriendo->Fecha_inicio)->format('d/m/Y'));
        $template->setValue('hora', date('H:i', strtotime($arriendo->Fecha_inicio ?? now())));
        $template->setValue('total', number_format($arriendo->Precio_total, 0, ',', '.'));

        // 🧮 Detalles de equipos
        $detalles = $arriendo->detalles;

        // Clonar filas en la tabla según cantidad de equipos
        $template->cloneRow('equipo', $detalles->count());

        foreach ($detalles as $index => $detalle) {
            $num = $index + 1;

            $tipo = strtolower(optional($detalle->equipo)->Nombre_equipos);
            $id = $detalle->Equipo_detalle_id;

            // Buscar modelo según tipo
            $modelo = match (true) {
                str_contains($tipo, 'bomba') => \App\Models\Bomba::find($id),
                str_contains($tipo, 'cabezal') => \App\Models\Cabezal::find($id),
                str_contains($tipo, 'cilindro') => \App\Models\Cilindro::find($id),
                str_contains($tipo, 'pistola') => \App\Models\Pistola::find($id),
                str_contains($tipo, 'dado') => \App\Models\Dado::find($id),
                default => null,
            };

            if (!$modelo) {
                $descripcion = 'Equipo desconocido';
            } elseif ($modelo instanceof \App\Models\Dado) {
                // Caso especial para DADO
                $descripcion = "{$modelo->Equipo} - {$modelo->Medida} ({$modelo->Cuadrante})";
            } elseif (isset($modelo->Codigo) && !empty($modelo->Codigo)) {
                $descripcion = "{$modelo->Equipo} {$modelo->Modelo} (COD: {$modelo->Codigo})";
            } elseif (isset($modelo->Serie) && !empty($modelo->Serie)) {
                $descripcion = "{$modelo->Equipo} {$modelo->Modelo} (Serie: {$modelo->Serie})";
            } else {
                $descripcion = "{$modelo->Equipo} {$modelo->Modelo}";
            }

            // Reemplazar variables con índice (#)
            $template->setValue("equipo#{$num}", $descripcion);
            $template->setValue("precio#{$num}", number_format($detalle->Precio_equipo, 0, ',', '.'));
            $template->setValue("garantia#{$num}", number_format($detalle->Garantia, 0, ',', '.'));
        }

        // 💾 Guardar el nuevo DOCX
        $template->saveAs($outputDocx);

        // 🔄 Convertir a PDF (requiere LibreOffice)
        $command = "soffice --headless --convert-to pdf " . escapeshellarg($outputDocx) . " --outdir " . escapeshellarg(dirname($outputPdf));
        exec($command);

        // 🔗 Guardar ruta del contrato en DB
        $arriendo
        ->ruta_contrato_pdf = "contratos/contrato_{$arriendo->Contrato}.pdf";
        $arriendo
        ->saveQuietly();
    }

}
