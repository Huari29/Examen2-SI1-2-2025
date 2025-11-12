<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return view('gestion-academica.materias.index', compact('materias'));
    }

    public function create()
    {
        return view('gestion-academica.materias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:materia,codigo',
            'nombre' => 'required',
            'carga_horaria' => 'required|integer|min:1',
        ]);

        Materia::create($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente.');
    }

    public function edit(Materia $materia)
    {
        return view('gestion-academica.materias.edit', compact('materia'));
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'codigo' => 'required|unique:materia,codigo,' . $materia->id_materia . ',id_materia',
            'nombre' => 'required',
            'carga_horaria' => 'required|integer|min:1',
        ]);

        $materia->update($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente.');
    }
}
