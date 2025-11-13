<x-layouts.app :title="__('Generar Reportes')">
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-semibold text-neutral-100 mb-6 text-center">Generar Reportes</h1>

        @if (session('error'))
            <div class="bg-red-600 text-white p-3 rounded-lg mb-4 text-center shadow-lg">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('reportes.generar') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-neutral-200">Tipo de reporte</label>
                <select name="tipo" class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white" required>
                    <option value="">-- Selecciona --</option>
                    <option value="asistencia">Asistencia Docente</option>
                    <option value="horario">Horarios</option>
                    <option value="aula">Aulas</option>
                    <option value="carga">Carga Horaria</option>
                </select>
            </div>

            <div>
                <label class="block text-neutral-200">Docente</label>
                <select name="docente" class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white">
                    <option value="">Todos</option>
                    @foreach ($docentes as $docente)
                        <option value="{{ $docente->id_usuario }}">{{ $docente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-neutral-200">Fecha inicio</label>
                    <input type="date" name="fecha_inicio" class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white">
                </div>
                <div>
                    <label class="block text-neutral-200">Fecha fin</label>
                    <input type="date" name="fecha_fin" class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white">
                </div>
            </div>

            <div>
                <label class="block text-neutral-200">Gestión</label>
                <input type="text" name="gestion" placeholder="Ej. 2025-I"
                       class="w-full bg-neutral-800 border border-neutral-600 rounded-lg px-3 py-2 text-white">
            </div>

            <div class="flex justify-between items-center mt-6">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    Generar Reporte
                </button>
                <button type="submit" name="exportar_pdf" value="1" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Exportar a PDF
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
