<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        $aulas = Aula::all();
        return view('aulas.index', compact('aulas'));
    }

    public function create()
    {
        return view('aulas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:aula,codigo',
            'nombre' => 'required',
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'nullable|string|max:255',
            'activo' => 'required|boolean',
        ]);

        Aula::create($request->all());
        return redirect()->route('aulas.index')->with('success', 'Aula registrada correctamente.');
    }

    public function edit(Aula $aula)
    {
        return view('aulas.edit', compact('aula'));
    }

    public function update(Request $request, Aula $aula)
    {
        $request->validate([
            'codigo' => 'required|unique:aula,codigo,' . $aula->id_aula . ',id_aula',
            'nombre' => 'required',
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'nullable|string|max:255',
            'activo' => 'required|boolean',
        ]);

        $aula->update($request->all());
        return redirect()->route('aulas.index')->with('success', 'Aula actualizada correctamente.');
    }

    public function destroy(Aula $aula)
    {
        $aula->delete();
        return redirect()->route('aulas.index')->with('success', 'Aula eliminada correctamente.');
    }
}
