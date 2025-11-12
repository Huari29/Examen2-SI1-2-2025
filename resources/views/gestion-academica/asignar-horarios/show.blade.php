<x-layouts.app :title="__('Asignar Horario')">
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-lg space-y-6">
        <h2 class="text-2xl font-semibold text-gray-800">Asignar Horario</h2>

        @if($mensaje)
            <div class="p-3 rounded-lg text-center text-white {{ str_contains($mensaje, '⚠️') ? 'bg-red-500' : 'bg-green-600' }}">
                {{ $mensaje }}
            </div>
        @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-600">Materia - Grupo</label>
                <select wire:model="materia_grupo_id" class="w-full border-gray-300 rounded-lg">
                    <option value="">Seleccione</option>
                    @foreach($materias as $m)
                        <option value="{{ $m->id_mg }}">{{ $m->materia->nombre }} - {{ $m->grupo->codigo }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-600">Docente</label>
                <select wire:model="docente_id" class="w-full border-gray-300 rounded-lg">
                    <option value="">Seleccione</option>
                    @foreach($docentes as $d)
                        <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-600">Aula</label>
                <select wire:model="aula_id" class="w-full border-gray-300 rounded-lg">
                    <option value="">Seleccione</option>
                    @foreach($aulas as $a)
                        <option value="{{ $a->id_aula }}">{{ $a->nombre }} - {{ $a->ubicacion }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-600">Día</label>
                <select wire:model="dia_semana" class="w-full border-gray-300 rounded-lg">
                    <option value="">Seleccione</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miércoles">Miércoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-600">Hora inicio</label>
                <input type="time" wire:model="hora_inicio" class="w-full border-gray-300 rounded-lg" />
            </div>

            <div>
                <label class="block text-gray-600">Hora fin</label>
                <input type="time" wire:model="hora_fin" class="w-full border-gray-300 rounded-lg" />
            </div>
        </div>

        <div class="flex justify-end">
            <button wire:click="asignarHorario"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                Asignar Horario
            </button>
        </div>
    </div>
</x-layouts.app>
