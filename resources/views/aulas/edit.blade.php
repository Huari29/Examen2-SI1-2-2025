<x-layouts.app :title="__('Editar Aula')">
    <div class="p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Editar Aula</h1>

        <form action="{{ route('aulas.update', $aula) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Código</label>
                <input type="text" name="codigo" value="{{ $aula->codigo }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Nombre</label>
                <input type="text" name="nombre" value="{{ $aula->nombre }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Capacidad</label>
                <input type="number" name="capacidad" value="{{ $aula->capacidad }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Ubicación</label>
                <input type="text" name="ubicacion" value="{{ $aula->ubicacion }}" class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Activo</label>
                <select name="activo" class="w-full border rounded-lg px-3 py-2">
                    <option value="1" @selected($aula->activo)>Sí</option>
                    <option value="0" @selected(!$aula->activo)>No</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Actualizar</button>
            <a href="{{ route('aulas.index') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
        </form>
    </div>
</x-layouts.app>
