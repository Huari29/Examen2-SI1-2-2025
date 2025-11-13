<x-layouts.app :title="__('Gestión de Usuarios')">
    <div class="flex justify-center py-10">
        <div class="p-8">
            <h1 class="text-3xl font-semibold mb-6 text-neutral-100 text-center">Lista de Usuarios</h1>

            <a href="{{ route('usuarios.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Nuevo Usuario
            </a>

            <div class="mt-6 overflow-x-auto rounded-xl border border-neutral-600 bg-neutral-900">
                <table class="min-w-full text-left text-sm text-neutral-100 border-collapse">
                    <thead class="bg-neutral-800">
                        <tr>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">Nombre</th>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">Correo</th>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">Rol</th>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">Activo</th>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($usuarios as $usuario)
                            <tr class="hover:bg-neutral-800 transition-colors border-t border-neutral-600">
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $usuario->nombre }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $usuario->correo }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $usuario->rol->nombre ?? 'Sin rol' }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $usuario->activo ? 'Sí' : 'No' }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600 space-x-3">
                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="text-blue-500 hover:underline">Editar</a>
                                    <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('¿Eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No hay usuarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
