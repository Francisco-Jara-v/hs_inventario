<?php

namespace App\Filament\Resources\LlavesTorques\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;

class LlavesTorquesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Equipo')
                    ->searchable(),
                TextColumn::make('Marca')
                    ->searchable(),
                
                TextColumn::make('Modelo')
                    ->searchable(),
                TextColumn::make('Serie')
                    ->searchable(),
                TextColumn::make('Codigo')
                    ->searchable(),
                TextColumn::make('Cuadrante')
                    ->searchable(),
                TextColumn::make('Torque')
                    ->searchable(),
                TextColumn::make('Precio')
                    ->searchable(),
                TextColumn::make('Garantia')
                    ->searchable(),
                TextColumn::make('Estado')
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
