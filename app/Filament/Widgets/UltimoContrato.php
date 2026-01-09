<?php

namespace App\Filament\Widgets;

use App\Models\Arriendo;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class UltimoContrato extends BaseWidget
{
    protected static ?string $heading = 'Arriendos en Curso';
    protected int|string|array $columnSpan = 'full';
    protected function getTableQuery(): Builder
    {
        return Arriendo::query()
            ->where('estado', 'En curso');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('Contrato')->label('N° Contrato'),
            Tables\Columns\TextColumn::make('cliente.Empresa')->label('Cliente'),
            Tables\Columns\TextColumn::make('Fecha_inicio')->label('Inicio')->date(),
            Tables\Columns\TextColumn::make('Fecha_fin')->label('Término')->date(),
            Tables\Columns\TextColumn::make('Precio_total')->label('Monto Total')->money('CLP', true),
        ];
    }
    
}