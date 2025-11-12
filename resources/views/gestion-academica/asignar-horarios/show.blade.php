<x-layouts.app.sidebar :title="__('Asignar Horario')">
    <flux:main>
        {{-- Notificación de éxito o error --}}
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

            <div class="space-y-4">
                {{-- Materia - Grupo --}}
                <div>
                    <label class="block font-medium text-neutral-100">Materia - Grupo</label>
                    <select wire:model="materia_grupo_id" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100">
                        <option value="">Seleccione materia y grupo</option>
                        @foreach($materias as $mg)
                            <option value="{{ $mg->id_mg }}">
                                {{ $mg->materia->nombre }} - {{ $mg->grupo->codigo }}
                            </option>
                        @endforeach
                    </select>
                    @error('materia_grupo_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Docente --}}
                <div>
                    <label class="block font-medium text-neutral-100">Docente</label>
                    <select wire:model="docente_id" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100">
                        <option value="">Seleccione docente</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('docente_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Aula --}}
                <div>
                    <label class="block font-medium text-neutral-100">Aula</label>
                    <select wire:model="aula_id" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100">
                        <option value="">Seleccione aula</option>
                        @foreach($aulas as $aula)
                            <option value="{{ $aula->id_aula }}">{{ $aula->nombre }} ({{ $aula->capacidad }} personas)</option>
                        @endforeach
                    </select>
                    @error('aula_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Día --}}
                <div>
                    <label class="block font-medium text-neutral-100">Día</label>
                    <select wire:model="dia_semana" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100">
                        <option value="">Seleccione día</option>
                        @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'] as $dia)
                            <option value="{{ $dia }}">{{ $dia }}</option>
                        @endforeach
                    </select>
                    @error('dia_semana') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Horas --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-neutral-100">Hora inicio</label>
                        <input type="time" wire:model="hora_inicio" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" />
                        @error('hora_inicio') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-medium text-neutral-100">Hora fin</label>
                        <input type="time" wire:model="hora_fin" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" />
                        @error('hora_fin') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Gestión --}}
                <div>
                    <label class="block font-medium text-neutral-100">Gestión</label>
                    <select wire:model="gestion" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100">
                        @foreach(['2025-1','2025-2','2025-3'] as $g)
                            <option value="{{ $g }}">{{ $g }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button wire:click="asignarHorario" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Asignar Horario
                </button>
                <button wire:click="$reset" 
                        class="ml-2 text-gray-300 hover:underline">
                    Cancelar
                </button>
            </div>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
