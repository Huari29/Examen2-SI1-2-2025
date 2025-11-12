<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Registra los comandos personalizados de Artisan.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        // Si tienes rutas de comandos definidas en routes/console.php
        require base_path('routes/console.php');
    }

    /**
     * Define el schedule (tareas automáticas).
     */
    protected function schedule(Schedule $schedule): void
    {
        // 🔹 Programa el comando para marcar faltas todos los días a las 23:59
        $schedule->command('asistencias:marcar-faltas')->dailyAt('23:59');

        // Puedes agregar otros comandos programados aquí más adelante, por ejemplo:
        // $schedule->command('backups:run')->dailyAt('02:00');
    }
}
