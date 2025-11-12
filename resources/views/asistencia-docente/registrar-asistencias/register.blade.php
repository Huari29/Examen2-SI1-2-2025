<x-layouts.app.sidebar :title="__('Registrar Asistencia Docente')">
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

        <div class="p-6 max-w-2xl mx-auto">
            <h1 class="text-2xl font-semibold mb-4 text-neutral-100 text-center">Registrar Asistencia</h1>

            {{-- Si no hay materias disponibles en horario actual --}}
            @if ($materias->isEmpty())
                <div class="bg-yellow-600 text-white text-center py-3 rounded-lg">
                    ⚠️ No tienes clases programadas en este momento.
                </div>
            @else
                <form action="{{ route('asistencia.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- Seleccionar materia y grupo --}}
                    <div>
                        <label class="block font-medium text-neutral-100">Materia - Grupo</label>
                        <select name="id_mg" id="id_mg" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                            <option value="">Seleccione materia y grupo</option>
                            @foreach($materias as $mg)
                                <option value="{{ $mg->id_mg }}">
                                    {{ $mg->materia->nombre }} - {{ $mg->grupo->codigo }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Observación --}}
                    <div>
                        <label class="block font-medium text-neutral-100">Observación (opcional)</label>
                        <textarea name="observacion" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100"></textarea>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button 
                            type="submit" 
                            id="btnRegistrar" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg transition opacity-50 cursor-not-allowed"
                            disabled>
                            Registrar Asistencia
                        </button>
                    </div>
                </form>
            @endif
        </div>

        <script>
            // Habilita el botón cuando selecciona una materia-grupo
            const select = document.getElementById('id_mg');
            const btn = document.getElementById('btnRegistrar');

            select?.addEventListener('change', () => {
                if (select.value) {
                    btn.disabled = false;
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    btn.classList.add('hover:bg-blue-700');
                } else {
                    btn.disabled = true;
                    btn.classList.add('opacity-50', 'cursor-not-allowed');
                    btn.classList.remove('hover:bg-blue-700');
                }
            });
        </script>
    </flux:main>
</x-layouts.app.sidebar>
