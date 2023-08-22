<?php

namespace App\Console\Commands;

use App\Models\ConciTiempo;
use App\Models\Tramiteusuario;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Desestimiento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:desestimiento';

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
    
        $diasParam = ConciTiempo::firstOrNew()->tiempo;
    
            Tramiteusuario::whereDate('created_at', '<=', now()->subWeekdays($diasParam))
            ->where('estado_tramite', 'Remitido')
            ->each(function ($registro) use ($diasParam) {
                $registro->realizarCambioEstadoDespuesDeDias($diasParam);
            });
           


    }
}
