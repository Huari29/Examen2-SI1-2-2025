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

            <form action="{{ route('asistencia.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Seleccionar materia y grupo --}}
                <div>
                    <label class="block font-medium text-neutral-100">Materia - Grupo</label>
                    <select name="id_mg" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        <option value="">Seleccione materia y grupo</option>
                        @foreach($materias as $mg)
                            <option value="{{ $mg->id_mg }}">
                                {{ $mg->materia->nombre }} - {{ $mg->grupo->codigo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Método de registro --}}
                <div>
                    <label class="block font-medium text-neutral-100">Método de registro</label>
                    <select name="metodo_registro" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100" required>
                        <option value="">Seleccione método</option>
                        <option value="formulario">Formulario</option>
                        <option value="qr">Código QR</option>
                    </select>
                </div>

                {{-- Observación --}}
                <div>
                    <label class="block font-medium text-neutral-100">Observación (opcional)</label>
                    <textarea name="observacion" class="w-full border rounded-lg px-3 py-2 bg-neutral-900 text-neutral-100"></textarea>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                        Registrar Asistencia
                    </button>
                </div>
            </form>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
