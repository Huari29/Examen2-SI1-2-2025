<x-layouts.app :title="__('Gestión de Aulas')">
    <div class="flex justify-center py-10">
        <div class="p-8">
            <h1 class="text-3xl font-semibold mb-6 text-neutral-100 text-center">Lista de Aulas</h1>

            <a href="{{ route('aulas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Nueva Aula
            </a>

            <div class="mt-6 overflow-x-auto rounded-xl">
                <table class="min-w-full text-left text-sm text-neutral-100 border-collapse">
                    <thead class="bg-neutral-800 border-b border-neutral-600">
                        <tr>
                            <th class="px-4 py-2 font-semibold">Código</th>
                            <th class="px-4 py-2 font-semibold">Nombre</th>
                            <th class="px-4 py-2 font-semibold">Capacidad</th>
                            <th class="px-4 py-2 font-semibold">Ubicación</th>
                            <th class="px-4 py-2 font-semibold">Activo</th>
                            <th class="px-4 py-2 text-center font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aulas as $aula)
                            <tr class="hover:bg-neutral-800 transition-colors border-t border-neutral-700">
                                <td class="px-4 py-2">{{ $aula->codigo }}</td>
                                <td class="px-4 py-2">{{ $aula->nombre }}</td>
                                <td class="px-4 py-2">{{ $aula->capacidad }}</td>
                                <td class="px-4 py-2">{{ $aula->ubicacion }}</td>
                                <td class="px-4 py-2">{{ $aula->activo ? 'Sí' : 'No' }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('aulas.edit', $aula) }}" class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('aulas.destroy', $aula) }}" method="POST" onsubmit="return confirm('¿Eliminar esta aula?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No hay aulas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
