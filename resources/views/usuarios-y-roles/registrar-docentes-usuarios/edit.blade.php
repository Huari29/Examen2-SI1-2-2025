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

            <div x-data="{ show: false }">
                <label class="block font-medium text-neutral-200">Nueva Contraseña (opcional)</label>

                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="contrasenia"
                        class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white pr-10"
                        placeholder="Dejar en blanco si no deseas cambiarla">

                    <!-- Botón de mostrar/ocultar -->
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 px-3 text-gray-400 hover:text-gray-200 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'hidden': show, 'block': !show }"
                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 3l18 18M9.88 9.88A3 3 0 0112 9c1.66 0 3 1.34 3 3a3 3 0 01-.88 2.12m-2.12.88a3 3 0 01-3-3m9-4.5C18.9 9.6 21 12 21 12s-2.1 2.4-4.5 4.5m-3.5 2a9 9 0 01-9-9 9 9 0 011.3-4.5M4.27 4.27L3 3" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'block': show, 'hidden': !show }"
                            class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <small class="text-gray-400">Si no escribes nada, la contraseña actual se mantendrá.</small>
            </div>


            <div>
                <label class="block font-medium text-neutral-200">Rol</label>
                <select name="id_rol"
                    class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white" required>
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
