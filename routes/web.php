<?php

use Illuminate\Support\Facades\Route;
//use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\HorarioController;
use App\Models\MateriaGrupo;
use App\Models\Aula;
use App\Models\Horario;
use App\Http\Controllers\LogSistemaController;
use App\Http\Controllers\InconsistenciaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('logs')->group(function () {
    Route::get('/', [LogSistemaController::class, 'index'])->name('logs.index');
    Route::delete('/{id}', [LogSistemaController::class, 'destroy'])->name('logs.destroy');
    Route::delete('/all', [LogSistemaController::class, 'destroyAll'])->name('logs.destroyAll');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.store');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('materias', MateriaController::class);

Route::resource('grupos', GrupoController::class);

Route::resource('aulas', AulaController::class);

Route::post('/asignar-horario', [HorarioController::class, 'asignarHorario'])->name('detalle-horario.store');
// Ruta GET para mostrar el formulario de asignar horario
/*Route::get('/asignar-horario', function () {
    $materiaGrupos = MateriaGrupo::with('materia','docente')->get();
    $aulas = Aula::all();
    $horarios = Horario::all();
    return view('gestion-academica.asignar-horarios.show', compact('materiaGrupos','aulas','horarios'));
})->name('detalle-horario.create');*/

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    /*Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');*/
});



Route::middleware(['auth'])->group(function () {
    Route::get('/asignar-horario', [HorarioController::class, 'create'])->name('detalle-horario.create');
    Route::post('/asignar-horario', [HorarioController::class, 'store'])->name('detalle-horario.store');
});

Route::get('/asistencia/registrar', [App\Http\Controllers\AsistenciaController::class, 'create'])->name('asistencia.create');
Route::post('/asistencia/registrar', [App\Http\Controllers\AsistenciaController::class, 'store'])->name('asistencia.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/asistencias/validar', [App\Http\Controllers\AsistenciaValidacionController::class, 'index'])->name('asistencias.validar.index');
    Route::put('/asistencias/validar/{id}', [App\Http\Controllers\AsistenciaValidacionController::class, 'update'])->name('asistencias.validar.update');
});

// Docente
Route::middleware(['auth'])->group(function () {
    Route::get('/inconsistencias', [InconsistenciaController::class, 'indexDocente'])->name('inconsistencias.docente');
    Route::post('/inconsistencias/{id}/justificar', [InconsistenciaController::class, 'justificar'])->name('inconsistencias.justificar');
});

// Administrador
Route::middleware(['auth'/*, 'can:isAdmin'*/])->group(function () {
    Route::get('/inconsistencias/admin', [InconsistenciaController::class, 'indexAdmin'])->name('inconsistencias.admin');
    Route::post('/inconsistencias/{id}/resolver', [InconsistenciaController::class, 'resolver'])->name('inconsistencias.resolver');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
});

Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::post('/reportes/generar', [ReporteController::class, 'generar'])->name('reportes.generar');
