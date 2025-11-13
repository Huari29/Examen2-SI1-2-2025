<x-layouts.app :title="__('Editar Usuario')">
    <div class="p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold mb-4 text-neutral-100">Editar Usuario</h1>

        <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium text-neutral-200">Nombre</label>
                <input type="text" name="nombre" value="{{ $usuario->nombre }}" 
                       class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white" required>
            </div>

            <div>
                <label class="block font-medium text-neutral-200">Correo</label>
                <input type="email" name="correo" value="{{ $usuario->correo }}" 
                       class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white" required>
            </div>

            <div>
                <label class="block font-medium text-neutral-200">Rol</label>
                <select name="id_rol" class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white" required>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}" @selected($usuario->id_rol == $rol->id_rol)>{{ $rol->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium text-neutral-200">Activo</label>
                <select name="activo" class="bg-neutral-800 border border-neutral-600 text-white rounded-lg px-3 py-2">
                    <option value="1" @selected($usuario->activo)>Sí</option>
                    <option value="0" @selected(!$usuario->activo)>No</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Actualizar
            </button>
            <a href="{{ route('usuarios.index') }}" class="ml-2 text-gray-400 hover:underline">Cancelar</a>
        </form>
    </div>
</x-layouts.app>
