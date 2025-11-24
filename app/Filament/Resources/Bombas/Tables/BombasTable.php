<?php

namespace App\Filament\Resources\Bombas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BombasTable
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
                TextColumn::make('Precio')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('Garantia')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('Estado'),
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
