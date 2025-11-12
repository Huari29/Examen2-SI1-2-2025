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

                {{-- Materia --}}
                <div>
                    <label class="block font-medium text-neutral-100">Materia</label>
                    <select name="id_materia" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        <option value="">Seleccione materia</option>
                        @foreach($materias as $materia)
                            <option value="{{ $materia->id_materia }}">{{ $materia->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Grupo --}}
                <div>
                    <label class="block font-medium text-neutral-100">Grupo</label>
                    <select name="id_grupo" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        <option value="">Seleccione grupo</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id_grupo }}">{{ $grupo->nombre." - ".$grupo->turno}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Docente --}}
                <div>
                    <label class="block font-medium text-neutral-100">Docente</label>
                    <select name="id_docente" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        <option value="">Seleccione docente</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id_usuario }}">{{ $docente->nombre }}</option>
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

                {{-- Días --}}
                <div>
                    <label class="block font-medium text-neutral-100 mb-2">Días</label>
                    <div class="flex flex-wrap gap-3">
                        @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'] as $dia)
                            <label class="flex items-center space-x-2 cursor-pointer bg-neutral-800 px-4 py-2 rounded-full hover:bg-neutral-700 transition">
                                <input 
                                    type="checkbox" 
                                    name="dias[]" 
                                    value="{{ $dia }}" 
                                    class="form-checkbox text-blue-500 rounded-full focus:ring-blue-500 focus:ring-2"
                                >
                                <span class="text-neutral-100">{{ $dia }}</span>
                            </label>
                        @endforeach
                    </div>
                    <p class="text-sm text-neutral-400 mt-1">Puedes seleccionar varios días.</p>
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
