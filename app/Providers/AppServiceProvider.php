<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Observers\SistemaObserver;

use App\Models\{
    Usuario, Rol, Grupo, Materia, Horario,
    MateriaGrupo, Aula, DetalleHorario,
    Asistencia, Evaluacion, AuditoriaAcademica, LogSistema
};


class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Observers para todos los modelos
        $modelos = [
            Usuario::class, Rol::class, Grupo::class, Materia::class, Horario::class,
            MateriaGrupo::class, Aula::class, DetalleHorario::class,
            Asistencia::class, Evaluacion::class, AuditoriaAcademica::class
        ];

        foreach ($modelos as $modelo) {
            $modelo::observe(SistemaObserver::class);
        }

        // Observer específico para LogSistema
        //LogSistema::observe(SistemaObserver::class);

        // Login: crear registro en LogSistema
        Event::listen(Login::class, function ($event) {
            LogSistema::create([
                'id_usuario' => $event->user->id_usuario ?? null,
                'modulo' => 'AUTENTICACION',
                'accion' => 'INICIO_SESION',
                'descripcion' => 'Usuario inició sesión.',
                'ip' => Request::ip(),
                'navegador' => Request::header('User-Agent'),
                'creado_en' => now(),
            ]);
        });

        // Logout: con try/catch para que no bloquee
        Event::listen(Logout::class, function ($event) {
            try {
                LogSistema::create([
                    'id_usuario' => $event->user->id_usuario ?? null,
                    'modulo' => 'AUTENTICACION',
                    'accion' => 'CIERRE_SESION',
                    'descripcion' => 'Usuario cerró sesión.',
                    'ip' => Request::ip(),
                    'navegador' => Request::header('User-Agent'),
                    'creado_en' => now(),
                ]);
            } catch (\Exception $e) {
                \Log::error("Error registrando logout en log_sistema: " . $e->getMessage());
            }
        });

        // Intentos fallidos de login
        Event::listen(Failed::class, function ($event) {
            LogSistema::create([
                'id_usuario' => null,
                'modulo' => 'AUTENTICACION',
                'accion' => 'INTENTO_FALLIDO',
                'descripcion' => 'Intento de login fallido con correo: ' . ($event->credentials['correo'] ?? $event->credentials['email'] ?? ''),
                'ip' => Request::ip(),
                'navegador' => Request::header('User-Agent'),
                'creado_en' => now(),
            ]);
        });
    }
}
