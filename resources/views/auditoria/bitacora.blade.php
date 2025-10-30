<x-layouts.app :title="__('Bitácora')">
    <div class="flex justify-center py-10">
        <div class="p-8 w-full max-w-7xl">
            <h1 class="text-3xl font-semibold mb-6 text-neutral-100 text-center">Bitácora del Sistema</h1>

            <div class="flex justify-between mb-4">
                <a href="{{ url()->previous() }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Volver</a>
                <form action="{{ route('logs.destroyAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                        onclick="return confirm('¿Eliminar todos los registros?')">Eliminar Todo</button>
                </form>
            </div>

            <div class="overflow-x-auto rounded-xl border border-neutral-600 bg-neutral-900">
                <table class="min-w-full text-left text-sm text-neutral-100 border-collapse">
                    <thead class="bg-neutral-800">
                        <tr>
                            <th class="px-4 py-2 border-r border-neutral-600">ID</th>
                            <th class="px-4 py-2 border-r border-neutral-600">Módulo</th>
                            <th class="px-4 py-2 border-r border-neutral-600">Acción</th>
                            <th class="px-4 py-2 border-r border-neutral-600">Descripción</th>
                            <th class="px-4 py-2 border-r border-neutral-600">Usuario</th>
                            <th class="px-4 py-2 border-r border-neutral-600">IP</th>
                            <th class="px-4 py-2 border-r border-neutral-600">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr class="hover:bg-neutral-800 border-t border-neutral-600">
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $log->id_log }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $log->modulo }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600 font-bold">{{ $log->accion }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $log->descripcion }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $log->usuario?->nombre ?? 'Sistema' }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $log->ip ?? 'Desconocida' }}</td>
                                <td class="px-4 py-2 border-r border-neutral-600">{{ $log->creado_en->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
