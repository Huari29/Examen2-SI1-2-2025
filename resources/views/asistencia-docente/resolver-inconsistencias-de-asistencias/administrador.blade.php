<x-layouts.app.sidebar :title="__('Validar Inconsistencias de Asistencia')">
    <flux:main>
        <div class="max-w-6xl mx-auto p-6">
            <h1 class="text-2xl font-semibold text-neutral-100 mb-6 text-center">
                Asistencias Pendientes de Validación
            </h1>

            {{-- Mensajes --}}
            @if (session('success'))
                <div class="bg-green-600 text-white p-3 rounded-lg mb-4 text-center shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-600 text-white p-3 rounded-lg mb-4 text-center shadow-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if ($inconsistencias->isEmpty())
                <p class="text-gray-400 text-center mt-10">✅ No hay inconsistencias pendientes de validación.</p>
            @else
                <div class="overflow-x-auto rounded-xl border border-neutral-700">
                    <table class="min-w-full text-sm text-neutral-100">
                        <thead class="bg-neutral-800 text-gray-300 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3 text-left">Docente</th>
                                <th class="px-4 py-3 text-left">Materia - Grupo</th>
                                <th class="px-4 py-3 text-left">Aula</th>
                                <th class="px-4 py-3 text-left">Fecha</th>
                                <th class="px-4 py-3 text-left">Justificación</th>
                                <th class="px-4 py-3 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-800 bg-neutral-900">
                            @foreach ($inconsistencias as $asistencia)
                                <tr class="hover:bg-neutral-800 transition">
                                    <td class="px-4 py-3">{{ $asistencia->detalleHorario->materiaGrupo->docente->nombre ?? 'Sin asignar' }}</td>
                                    <td class="px-4 py-3">
                                        {{ $asistencia->detalleHorario->materiaGrupo->materia->nombre }}
                                        - {{ $asistencia->detalleHorario->materiaGrupo->grupo->codigo }}
                                    </td>
                                    <td class="px-4 py-3">{{ $asistencia->detalleHorario->aula->nombre ?? 'N/A' }}</td>
                                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">{{ $asistencia->observacion ?? 'Sin justificación' }}</td>
                                    <td class="px-4 py-3 text-center space-x-2">
                                        <form action="{{ route('inconsistencias.resolver', $asistencia->id_asistencia) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="accion" value="aceptar">
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-sm">
                                                Aceptar
                                            </button>
                                        </form>

                                        <form action="{{ route('inconsistencias.resolver', $asistencia->id_asistencia) }}" method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="accion" value="rechazar">
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm">
                                                Rechazar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </flux:main>
</x-layouts.app.sidebar>
