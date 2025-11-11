<?php

namespace App\Filament\Resources\Arriendos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArriendosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cliente.Empresa')
                    ->label('Cliente')
                    ->sortable()
                    ->searchable(),
            
                TextColumn::make('Contrato')
                    ->sortable(),
            
                TextColumn::make('Fecha_inicio')
                    ->date()
                    ->sortable(),
            
                TextColumn::make('Fecha_fin')
                    ->date()
                    ->sortable(),
            
                TextColumn::make('Guia_Despacho')
                    ->sortable(),
            
                TextColumn::make('Precio_total')
                    ->numeric()
                    ->sortable()
                    ->money('CLP'),
            
                TextColumn::make('Estado')
                    ->badge()
                    ->colors([
                        'success' => 'En curso',
                        'danger' => 'Cancelado',
                        'warning' => 'Finalizado',
                    ]),
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
