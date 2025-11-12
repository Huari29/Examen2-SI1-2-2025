<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DetalleHorario;
use App\Models\Asistencia;
use Carbon\Carbon;

class MarcarFaltasCommand extends Command
{
    /**
     * El nombre y la firma del comando de consola.
     *
     * Lo usarás así: php artisan asistencias:marcar-faltas
     */
    protected $signature = 'asistencias:marcar-faltas';

    /**
     * Descripción del comando
     */
    protected $description = 'Marca como falta a los docentes que no registraron asistencia dentro de su horario.';

    /**
     * Ejecuta el comando
     */
    public function handle()
    {
        $hoy = Carbon::now()->toDateString();
        $diaSemana = ucfirst(Carbon::now()->locale('es')->dayName);

        $this->info("🕓 Procesando asistencias del día: $diaSemana ($hoy)");

        // 🔹 Obtener todos los horarios activos del día actual
        $detalles = DetalleHorario::with(['materiaGrupo.docente'])
            ->where('dia_semana', $diaSemana)
            ->get();

        $totalFaltas = 0;

        foreach ($detalles as $detalle) {
            $asistencia = Asistencia::where('id_detalle', $detalle->id_detalle)
                ->whereDate('fecha', $hoy)
                ->first();

            if (!$asistencia) {
                // 🔸 Crear asistencia automática con estado FALTA
                Asistencia::create([
                    'id_detalle' => $detalle->id_detalle,
                    'fecha' => $hoy,
                    'estado' => 'Falta',
                    'metodo_registro' => 'Automático',
                    'observacion' => 'No marcó asistencia dentro del horario.',
                    'registrada_por' => null,
                    'creado_en' => Carbon::now(),
                ]);

                $docente = $detalle->materiaGrupo->docente->nombre ?? 'Desconocido';
                $this->line("❌ Falta registrada para: {$docente}");
                $totalFaltas++;
            }
        }

        if ($totalFaltas > 0) {
            $this->info("✅ Se marcaron {$totalFaltas} faltas correctamente.");
        } else {
            $this->info("✅ No se detectaron faltas hoy.");
        }

        return Command::SUCCESS;
    }
}
