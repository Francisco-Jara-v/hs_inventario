<?php

namespace App\Filament\Resources\Mangueras\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;


class ManguerasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Equipo')
                    ->searchable(),
                TextColumn::make('Observacion')
                    ->searchable(),
                
                TextColumn::make('Cantidad_disponible')
                    ->searchable(),
                TextColumn::make('Cantidad_arriendo')
                    ->searchable(),
                TextColumn::make('Precio')
                    ->searchable(),
                TextColumn::make('Garantia')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
