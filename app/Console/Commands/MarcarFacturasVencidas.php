<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MarcarFacturasVencidas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:marcar-facturas-vencidas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $actualizadas = FacturaVenta::where('estado', 'PENDIENTE')
            ->whereDate('fecha_vencimiento', '<', now())
            ->update(['estado' => 'VENCIDA']);

        $this->info("Facturas vencidas actualizadas: {$actualizadas}");
    }
}
