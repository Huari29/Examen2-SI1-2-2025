<x-layouts.app :title="__('Editar Materia')">
    <div class="p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Editar Materia</h1>

        <form action="{{ route('materias.update', $materia) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Código</label>
                <input type="text" name="codigo" value="{{ $materia->codigo }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Nombre</label>
                <input type="text" name="nombre" value="{{ $materia->nombre }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Carga Horaria</label>
                <input type="number" name="carga_horaria" value="{{ $materia->carga_horaria }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Gestión Default</label>
                <input type="text" name="gestion_default" value="{{ $materia->gestion_default }}" class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Activo</label>
                <select name="activo" class="w-full border rounded-lg px-3 py-2">
                    <option value="1" @selected($materia->activo)>Sí</option>
                    <option value="0" @selected(!$materia->activo)>No</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Actualizar
            </button>
            <a href="{{ route('materias.index') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
        </form>
    </div>
</x-layouts.app>
