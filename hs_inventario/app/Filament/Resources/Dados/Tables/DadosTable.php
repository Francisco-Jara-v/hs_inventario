<?php

namespace App\Filament\Resources\Dados\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DadosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Equipo')
                    ->searchable(),
                TextColumn::make('Medida')
                    ->searchable(),
                TextColumn::make('Cuadrante')
                    ->searchable(),
                TextColumn::make('Cantidad')
                    ->searchable(),
                TextColumn::make('Precio')
                    ->searchable(),
                TextColumn::make('Garantia')
                    ->searchable(),
                
            
            ])
            ->filters([
                
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
