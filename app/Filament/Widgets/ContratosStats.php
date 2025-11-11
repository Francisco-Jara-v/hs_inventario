<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Arriendo;
use App\Models\Cliente;
use App\Models\Bomba;
use App\Models\Cabezal;
use App\Models\Cilindro;
use App\Models\Pistola;
use App\Models\Dado;

class ContratosStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Contratos Activos', Arriendo::where('Estado', 'En curso')->count())
                ->description('Actualmente en arriendo')
                ->icon('heroicon-o-clipboard-document-check')
                ->color('success'),
                
            Stat::make('Clientes Registrados', Cliente::count())
                ->description('Clientes totales')
                ->icon('heroicon-o-user-group')
                ->color('primary'),
                
            Stat::make('Equipos Disponibles', 
            Bomba::where('Estado', 'En stock')->count() +
            Cabezal::where('Estado', 'En stock')->count() +
            Cilindro::where('Estado', 'En stock')->count() +
            Pistola::where('Estado', 'En stock')->count() +
            Dado::sum('Cantidad_disponible')
            )
                ->description('Equipos listos para arriendo')
                ->color('info')
                ->icon('heroicon-o-wrench'),
                    
            Stat::make('Equipos en Arriendo', 
            Bomba::where('Estado', 'En arriendo')->count() +
            Cabezal::where('Estado', 'En arriendo')->count() +
            Cilindro::where('Estado', 'En arriendo')->count() +
            Pistola::where('Estado', 'En arriendo')->count() +
            Dado::sum('Cantidad_arriendo')
            )
                ->description('Equipos actualmente en arriendo')
                ->color('danger')
                ->icon('heroicon-o-wrench-screwdriver')
                    ];
    }
}