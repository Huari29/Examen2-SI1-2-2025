<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Mostrar lista de grupos.
     */
    public function index()
    {
        $grupos = Grupo::orderBy('id_grupo', 'desc')->get();
        return view('grupos.index', compact('grupos'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('grupos.create');
    }

    /**
     * Guardar nuevo grupo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo'   => 'required|string|max:10|unique:grupo,codigo',
            'nombre'   => 'required|string|max:100',
            'turno'    => 'required|string|max:20',
            'gestion'  => 'required|string|max:20',
            'activo'   => 'required|boolean',
        ]);

        $validated['creado_en'] = now();

        Grupo::create($validated);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Grupo $grupo)
    {
        return view('grupos.edit', compact('grupo'));
    }

    /**
     * Actualizar grupo.
     */
    public function update(Request $request, Grupo $grupo)
    {
        $validated = $request->validate([
            'codigo'   => 'required|string|max:10|unique:grupo,codigo,' . $grupo->id_grupo . ',id_grupo',
            'nombre'   => 'required|string|max:100',
            'turno'    => 'required|string|max:20',
            'gestion'  => 'required|string|max:20',
            'activo'   => 'required|boolean',
        ]);

        $grupo->update($validated);

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    /**
     * Eliminar grupo.
     */
    public function destroy(Grupo $grupo)
    {
        $grupo->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado correctamente.');
    }
}
