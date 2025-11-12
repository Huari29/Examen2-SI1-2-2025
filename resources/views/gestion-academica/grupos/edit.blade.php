<x-layouts.app :title="__('Editar Grupo')">
    <div class="p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Editar Grupo</h1>

        <form action="{{ route('grupos.update', $grupo) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Código</label>
                <input type="text" name="codigo" value="{{ $grupo->codigo }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Nombre</label>
                <input type="text" name="nombre" value="{{ $grupo->nombre }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Turno</label>
                <input type="text" name="turno" value="{{ $grupo->turno }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Gestión</label>
                <input type="text" name="gestion" value="{{ $grupo->gestion }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Activo</label>
                <select name="activo" class="w-full border rounded-lg px-3 py-2">
                    <option value="1" @selected($grupo->activo)>Sí</option>
                    <option value="0" @selected(!$grupo->activo)>No</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Actualizar
            </button>
            <a href="{{ route('grupos.index') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
        </form>
    </div>
</x-layouts.app>
