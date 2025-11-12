<?php

namespace App\Filament\Resources\Equipos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Actions;
use Filament\Tables\Action;
use Filament\Tables\Columns\TextColumn;
use Symfony\Component\Console\Color;

class EquiposTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Nombre_equipos')->label('Tipo'),
                TextColumn::make('Descripcion'),
                TextColumn::make('Cantidad_total'),  
            ])
            ->actions([
                ViewAction::make('ver')
                    ->label('Ver')
                    
                    ->url(fn($record) => match($record->Nombre_equipos) {
                        'Bomba' => route('filament.admin.resources.bombas.index'),
                        'Cilindro' => route('filament.admin.resources.cilindros.index'),
                        'Cabezal' => route('filament.admin.resources.cabezales.index'),
                        'Dado' => route('filament.admin.resources.dados.index'),
                        'Pistola' => route('filament.admin.resources.pistolas.index'),
                        default => '#',
                    }),
                ])
                ->recordUrl(fn($record) => match($record->Nombre_equipos) {
                    'Bomba' => route('filament.admin.resources.bombas.index'),
                    'Cilindro' => route('filament.admin.resources.cilindros.index'),
                    'Cabezal' => route('filament.admin.resources.cabezales.index'),
                    'Dado' => route('filament.admin.resources.dados.index'),
                    'Pistola' => route('filament.admin.resources.pistolas.index'),
                    default => null,
                })
            ->filters([
                //
            ])
            ->defaultSort('Nombre_equipos');
        /*return $table
            ->columns([
                //
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordUrl(null)
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
            ]);*/
    }
}
