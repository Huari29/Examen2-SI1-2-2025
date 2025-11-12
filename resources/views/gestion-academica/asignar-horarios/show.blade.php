<x-layouts.app :title="__('Asignar Horario')">
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Asignar Horario</h1>

        <form action="{{ route('detalle-horario.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Materia / Docente -->
            <div>
                <label class="block font-medium">Materia - Docente</label>
                <select name="id_mg" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">Seleccione materia y docente</option>
                    @foreach($materiaGrupos as $mg)
                        <option value="{{ $mg->id_mg }}">
                            {{ $mg->materia->nombre }} - {{ $mg->docente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Aula -->
            <div>
                <label class="block font-medium">Aula</label>
                <select name="id_aula" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">Seleccione aula</option>
                    @foreach($aulas as $aula)
                        <option value="{{ $aula->id_aula }}">
                            {{ $aula->nombre }} ({{ $aula->capacidad }} personas)
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Horario -->
            <div>
                <label class="block font-medium">Horario</label>
                <select name="id_horario" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">Seleccione horario</option>
                    @foreach($horarios as $horario)
                        <option value="{{ $horario->id_horario }}">
                            {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Día de la semana -->
            <div>
                <label class="block font-medium">Día de la semana</label>
                <select name="dia_semana" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">Seleccione día</option>
                    @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'] as $dia)
                        <option value="{{ $dia }}">{{ $dia }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gestión -->
            <div>
                <label class="block font-medium">Gestión</label>
                <select name="gestion" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="">Seleccione gestión</option>
                    @foreach(['2025-1','2025-2','2025-3'] as $gestion)
                        <option value="{{ $gestion }}">{{ $gestion }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Asignar Horario
            </button>
            <a href="{{ route('detalle-horario.create') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
        </form>
    </div>
</x-layouts.app>
