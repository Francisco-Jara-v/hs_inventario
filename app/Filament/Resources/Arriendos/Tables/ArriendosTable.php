<?php

namespace App\Filament\Resources\Arriendos\Tables;

use App\Filament\Resources\Arriendos\Schemas\ArriendoForm;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use App\Filament\Resources\Arriendos\Tables\Action;
use Storage;

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
            ->recordUrl(null)

            ->filters([
                //
            ])
            ->recordActions([

                \Filament\Actions\Action::make('ver_pdf')
                ->label('Ver contrato')
                
                ->icon('heroicon-o-eye')
                ->color('gray')
                ->url(fn($record) => $record
                ->ruta_contrato_pdf
                    ? Storage::url($record->ruta_contrato_pdf)
                    : null,
                true)
                ->openUrlInNewTab()
                ->visible(fn($record) => !empty($record->ruta_contrato_pdf)),
                \Filament\Actions\Action::make('finalizar')
                ->label('Finalizar')
                ->icon('heroicon-o-check-circle')
                ->color('warning')
                ->requiresConfirmation()
                ->visible(fn($record) => $record->Estado === 'En curso')
                ->action(function($record){
                    $ahoraChile = Carbon::now('America/Santiago');
                    $record->update(['Estado' => 'Finalizado',
                    'Fecha_fin' => $ahoraChile
                    ]);

                    $detalles = $record
                    ->detalles()
                    ->get()
                    ->map(fn($d) =>[
                        'Precio_equipo' => $d
                        ->Precio_equipo,
                    ])
                    ->toArray();

                    
                    $nuevototal = ArriendoForm::calcularTotalDatos($detalles,$record->Fecha_inicio, $ahoraChile);

                    $record->update([
                    'Precio_total' => $nuevototal
                    ]);

                    Notification::make()
                    ->title('Contrato Finalizado')
                    ->success()
                    ->body("El contrato #{$record->Contrato} ha sido marcado como finalizado")
                    ->send();

                }),
                \filament\Actions\Action::make('cancelar')
                ->label('Cancelar')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Cancelar Arriendo')
                ->modalDescription('¿Estás seguro de cancelar este arriendo?. Esta acción no se puede deshacer.')
                ->visible(fn ($record) => $record->Estado === 'En curso')
                ->action(function ($record) {
                    $record->update([
                        'Estado' => 'Cancelado',
                    ]);
                }),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
