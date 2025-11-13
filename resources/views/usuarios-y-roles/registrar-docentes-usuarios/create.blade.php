<x-layouts.app :title="__('Registrar Usuario')">
    <div class="p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold mb-4 text-neutral-100">Registrar Usuario</h1>

        <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium text-neutral-200">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" 
                       class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white" required>
            </div>

            <div>
                <label class="block font-medium text-neutral-200">Correo</label>
                <input type="email" name="correo" value="{{ old('correo') }}" 
                       class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white" required>
            </div>

            <div>
                <label class="block font-medium text-neutral-200">Contraseña</label>
                <input type="password" name="contrasenia" 
                       class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white" required>
            </div>

            <div>
                <label class="block font-medium text-neutral-200">Rol</label>
                <select name="id_rol" class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white" required>
                    <option value="">-- Selecciona un rol --</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}">{{ $rol->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center space-x-2">
                <label for="activo" class="text-neutral-200">Activo:</label>
                <select name="activo" class="bg-neutral-800 border border-neutral-600 text-white rounded-lg px-3 py-2">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Guardar
            </button>
            <a href="{{ route('usuarios.index') }}" class="ml-2 text-gray-400 hover:underline">Cancelar</a>
        </form>
    </div>
</x-layouts.app>
