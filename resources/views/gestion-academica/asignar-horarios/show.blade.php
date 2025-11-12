<x-layouts.app.sidebar :title="__('Asignar Horario')">
    <flux:main>

        {{-- Mensajes --}}
        @if (session('success') || session('error'))
            <div class="flex justify-center mt-4">
                <div 
                    class="px-6 py-3 rounded-xl shadow-lg text-white font-medium transition-all duration-500
                        {{ session('success') ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">
                    {{ session('success') ?? session('error') }}
                </div>
            </div>
        @endif

        <div class="p-6 max-w-3xl mx-auto">
            <h1 class="text-2xl font-semibold mb-4 text-neutral-100 text-center">Asignar Horario</h1>

            <form action="{{ route('detalle-horario.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Materia - Grupo --}}
                <div>
                    <label class="block font-medium text-neutral-100">Materia - Grupo</label>
                    <select name="id_materia_grupo" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        <option value="">Seleccione materia y grupo</option>
                        @foreach($materiaGrupos as $mg)
                            <option value="{{ $mg->id_mg }}">
                                {{ $mg->materia->nombre }} - {{ $mg->grupo->codigo }} ({{ $mg->docente->nombre ?? 'Sin docente' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Docente --}}
                <div>
                    <label class="block font-medium text-neutral-100">Docente</label>
                    <select name="id_docente" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        <option value="">Seleccione docente</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Aula --}}
                <div>
                    <label class="block font-medium text-neutral-100">Aula</label>
                    <select name="id_aula" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        <option value="">Seleccione aula</option>
                        @foreach($aulas as $aula)
                            <option value="{{ $aula->id_aula }}">{{ $aula->nombre }} (Capacidad: {{ $aula->capacidad }})</option>
                        @endforeach
                    </select>
                </div>

                {{-- Día --}}
                <div>
                    <label class="block font-medium text-neutral-100">Día</label>
                    <select name="dia_semana" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        <option value="">Seleccione día</option>
                        @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'] as $dia)
                            <option value="{{ $dia }}">{{ $dia }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Horas --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-neutral-100">Hora inicio</label>
                        <input type="time" name="hora_inicio" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                    </div>
                    <div>
                        <label class="block font-medium text-neutral-100">Hora fin</label>
                        <input type="time" name="hora_fin" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                    </div>
                </div>

                {{-- Gestión --}}
                <div>
                    <label class="block font-medium text-neutral-100">Gestión</label>
                    <select name="gestion" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        @foreach(['2025-1','2025-2','2025-3'] as $g)
                            <option value="{{ $g }}">{{ $g }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                        Asignar Horario
                    </button>
                    <a href="{{ route('dashboard') }}" class="ml-2 text-gray-300 hover:underline">Cancelar</a>
                </div>
            </form>
        </div>
    </flux:main>
</x-layouts.app.sidebar>

