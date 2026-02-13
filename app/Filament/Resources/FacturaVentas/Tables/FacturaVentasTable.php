<?php

namespace App\Filament\Resources\FacturaVentas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions;


use Carbon\Carbon;

class FacturaVentasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('fecha_emision')
                    ->label('Fecha Emisión')
                    ->date('d-m-Y')
                    ->sortable(),

                TextColumn::make('fecha_vencimiento')
                    ->label('Fecha Vencimiento')
                    ->date('d-m-Y')
                    ->sortable(),

                /*TextColumn::make('periodo')
                    ->label('Periodo')
                    ->state(fn ($record) => $record->fecha_emision)
                    ->sortable(query: function ($query, $direction) {
                        $query->orderBy('fecha_emision', $direction);
                    })
                    ->formatStateUsing(fn ($state) =>
                        Carbon::parse($state)->translatedFormat('F Y')
                    ),*/
                TextColumn::make('tipo_documento')
                    ->label('Tipo de Documento')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('folio')
                    ->label('Folio')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('cliente.Rut')
                    ->label('Rut')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('cliente.Empresa')
                    ->label('Cliente')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total')
                    ->label('$ Monto')
                    ->money('CLP')
                    ->searchable(),   
                
                BadgeColumn::make('estado')
                    ->colors([
                        'warning' => 'EMITIDA',
                        'success' => 'PAGADA',
                        'gray' => 'ANULADA',
                        'danger' => 'VENCIDA'
                    ])
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                viewAction::make(),
                \filament\Actions\Action::make('pagar')
                ->label('Efectuar Pago')
                ->icon('heroicon-o-currency-dollar')
                ->color('success')
                ->visible(fn ($record) => $record->estado === 'EMITIDA')
                ->modalHeading('Registrar Pago')
                ->modalSubmitActionLabel('Confirmar Pago')
                ->form([
                    Select::make('forma_pago')
                        ->label('Método de Pago')
                        ->options([
                            'EFECTIVO' => 'Efectivo',
                            'TRANSFERENCIA' => 'Transferencia',
                            'TARJETA' => 'Tarjeta',
                            'CHEQUE' => 'Cheque',
                        ])
                        ->required(),
                        
                    DatePicker::make('fecha_pago')
                        ->label('Fecha de Pago')
                        ->default(now())
                        ->required(),
                ])
                ->action(function ($record, array $data) {
                    $record->update([
                        'forma_pago' => $data['forma_pago'],
                        'fecha_pago' => $data['fecha_pago'],
                        'estado' => 'PAGADA',
                    ]);
                }),
                \filament\Actions\Action::make('anular')
                ->label('Anular')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Anular factura')
                ->modalDescription('¿Estás seguro de anular esta factura? Esta acción no se puede deshacer.')
                ->visible(fn ($record) => $record->estado === 'EMITIDA')
                ->action(function ($record) {
                    $record->update([
                        'estado' => 'ANULADA',
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
