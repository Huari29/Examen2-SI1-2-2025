<x-layouts.app :title="__('Gestión de Materias')">
    <div class="flex justify-center py-10">
        <div class="p-8">

        <h1 class="text-3xl font-semibold mb-6 text-neutral-100 text-center">Lista de Materias</h1>

        <a href="{{ route('materias.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Nueva Materia
        </a>

        <div class="mt-6 overflow-x-auto rounded-xl border border-neutral-600 bg-neutral-900">
            <table class="min-w-full text-left text-sm text-neutral-100 border-collapse">
                 <thead class="bg-neutral-800">
                        <tr>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">{{ __('Código') }}</th>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">{{ __('Nombre') }}</th>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">Carga Horaria</th>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">Gestión</th>
                            <th class="px-4 py-2 border-r border-neutral-600 font-semibold">Activo</th>
                            <th class="px-4 py-2 text-center font-semibold">Acciones</th>
                        </tr>
                    </thead>
                <tbody>
                    @forelse ($materias as $materia)
                        <tr class="hover:bg-neutral-800 transition-colors border-t border-neutral-600">
                            <td class="px-4 py-2 border-r border-neutral-600">{{ $materia->codigo }}</td>
                            <td class="px-4 py-2 border-r border-neutral-600">{{ $materia->nombre }}</td>
                            <td class="px-4 py-2 border-r border-neutral-600">{{ $materia->carga_horaria }}</td>
                            <td class="px-4 py-2 border-r border-neutral-600">{{ $materia->gestion_default }}</td>
                            <td class="px-4 py-2 border-r border-neutral-600">{{ $materia->activo ? 'Sí' : 'No' }}</td>
                            <td class="px-4 py-2 border-r border-neutral-600">
                                <a href="{{ route('materias.edit', $materia) }}" class="text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('materias.destroy', $materia) }}" method="POST" onsubmit="return confirm('¿Eliminar esta materia?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No hay materias registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </div>
</x-layouts.app>
