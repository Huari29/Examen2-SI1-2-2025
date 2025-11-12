<x-layouts.app.sidebar :title="__('Validar Asistencia Docente')">
    <flux:main>
        {{-- Mensajes de éxito/error --}}
        @if (session('success') || session('error'))
            <div class="flex justify-center mt-4">
                <div 
                    class="px-6 py-3 rounded-xl shadow-lg text-white font-medium transition-all duration-500
                        {{ session('success') ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">
                    {{ session('success') ?? session('error') }}
                </div>
            </div>
        @endif

        <div class="p-6 max-w-6xl mx-auto">
            <h1 class="text-2xl font-semibold mb-6 text-neutral-100 text-center">
                Asistencias Pendientes de Validación
            </h1>

            <div class="overflow-x-auto rounded-xl border border-neutral-700">
                <table class="min-w-full text-sm text-neutral-100">
                    <thead class="bg-neutral-800 border-b border-neutral-700">
                        <tr>
                            <th class="px-4 py-2">Docente</th>
                            <th class="px-4 py-2">Materia - Grupo</th>
                            <th class="px-4 py-2">Aula</th>
                            <th class="px-4 py-2">Horario</th>
                            <th class="px-4 py-2">Fecha</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($asistencias as $asistencia)
                            <tr class="border-t border-neutral-700 hover:bg-neutral-800 transition">
                                <td class="px-4 py-2">
                                    {{ $asistencia->detalle->materiaGrupo->docente->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $asistencia->detalle->materiaGrupo->materia->nombre ?? 'N/A' }} -
                                    {{ $asistencia->detalle->materiaGrupo->grupo->codigo ?? '' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $asistencia->detalle->aula->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $asistencia->detalle->horario->hora_inicio ?? '' }} - 
                                    {{ $asistencia->detalle->horario->hora_fin ?? '' }}
                                </td>
                                <td class="px-4 py-2">{{ $asistencia->fecha }}</td>
                                <td class="px-4 py-2 flex justify-center gap-3">
                                    <form action="{{ route('asistencias.validar.update', $asistencia->id_asistencia) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="accion" value="validar">
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg">
                                            Validar
                                        </button>
                                    </form>

                                    <form action="{{ route('asistencias.validar.update', $asistencia->id_asistencia) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="accion" value="rechazar">
                                        <input type="text" name="observacion" placeholder="Motivo"
                                               class="w-32 px-2 py-1 rounded bg-neutral-900 text-neutral-100 text-xs">
                                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg">
                                            Rechazar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-neutral-400">
                                    No hay asistencias pendientes de validación.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
