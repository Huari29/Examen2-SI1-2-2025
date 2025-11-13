<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // 🔹 Listar usuarios
    public function index()
    {
        $usuarios = Usuario::with('rol')->get();
        return view('usuarios-y-roles.registrar-docentes-usuarios.index', compact('usuarios'));
    }

    // 🔹 Mostrar formulario de creación
    public function create()
    {
        $roles = Rol::all();
        return view('usuarios-y-roles.registrar-docentes-usuarios..create', compact('roles'));
    }

    // 🔹 Guardar usuario nuevo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'correo' => 'required|email|unique:usuario,correo',
            'contrasenia' => 'required|min:6',
            'id_rol' => 'required|exists:rol,id_rol',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasenia' => Hash::make($request->contrasenia),
            'id_rol' => $request->id_rol,
            'activo' => true,
            'creado_en' => now(),
        ]);

        return redirect()->route('usuarios.index')->with('success', '✅ Usuario registrado correctamente.');
    }

    // 🔹 Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all();
        return view('usuarios-y-roles.registrar-docentes-usuarios..edit', compact('usuario', 'roles'));
    }

    // 🔹 Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:150',
            'correo' => 'required|email|unique:usuario,correo,' . $id . ',id_usuario',
            'id_rol' => 'required|exists:rol,id_rol',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'id_rol' => $request->id_rol,
        ]);

        return redirect()->route('usuarios.index')->with('success', '✅ Usuario actualizado correctamente.');
    }

    // 🔹 Eliminar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', '🗑️ Usuario eliminado correctamente.');
    }
}
