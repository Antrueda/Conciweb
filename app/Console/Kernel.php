<?php

namespace App\Console;

use App\Models\ConciTiempo;
use App\Models\Tramiteusuario;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('desestimiento')->daily(); // Ejecutar diariamente

    //     $diasParam = ConciTiempo::firstOrNew()->tiempo;

    //     $schedule->call(function () use ($diasParam) {
    //         Tramiteusuario::whereDate('created_at', '<=', now()->subWeekdays($diasParam))
    //         ->where('estado_tramite', 'Remitido')
    //         ->each(function ($registro) use ($diasParam) {
    //             $registro->realizarCambioEstadoDespuesDeDias($diasParam);
    //         });
    // })->daily();

    
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        
        \App\Console\Commands\Desestimiento::class;
        require base_path('routes/console.php');
    }
}
