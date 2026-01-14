<?php

namespace App\Filament\Resources\FacturaCompras\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Carbon\Carbon;

class FacturaComprasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('fecha_emision')
                    ->label('Fecha Emisión')
                    ->date('d-m-Y')
                    ->sortable(),
                
                TextColumn::make('periodo')
                    ->label('Periodo')
                    ->state(fn ($record) => $record->fecha_emision)
                    ->sortable(query: function ($query, $direction) {
                        $query->orderBy('fecha_emision', $direction);
                    })
                    ->formatStateUsing(fn ($state) =>
                        Carbon::parse($state)->translatedFormat('F Y')
                    ),
                TextColumn::make('tipo_documento')
                    ->label('Tipo de Documento')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('folio')
                    ->label('Folio')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('proveedor_rut')
                    ->label('Rut')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('proveedor_nombre')
                    ->label('Proveedor')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total')
                    ->label('$ Monto')
                    ->money('CLP')
                    ->sortable()
                    ->searchable(),
                
                    
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
