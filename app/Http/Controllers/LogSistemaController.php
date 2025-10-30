<?php

namespace App\Http\Controllers;

use App\Models\LogSistema;

class LogSistemaController extends Controller
{
    public function index()
    {
        $logs = LogSistema::with('usuario')
            ->orderBy('creado_en', 'desc')
            ->paginate(10);

        return view('auditoria.bitacora', compact('logs'));
    }

    public function destroy($id)
    {
        $log = LogSistema::findOrFail($id);
        $log->delete();

        return redirect()->route('logs.index')
                         ->with('success', 'Registro eliminado correctamente.');
    }

    public function destroyAll()
    {
        LogSistema::truncate();
        return redirect()->route('logs.index')
                         ->with('success', 'Todos los registros eliminados.');
    }
    
}
