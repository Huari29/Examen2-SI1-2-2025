<x-layouts.app :title="__('Nueva Aula')">
    <div class="p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Registrar Aula</h1>

        <form action="{{ route('aulas.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Código</label>
                <input type="text" name="codigo" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Nombre</label>
                <input type="text" name="nombre" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Capacidad</label>
                <input type="number" name="capacidad" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Ubicación</label>
                <input type="text" name="ubicacion" class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Activo</label>
                <select name="activo" class="w-full border rounded-lg px-3 py-2">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Guardar</button>
            <a href="{{ route('aulas.index') }}" class="ml-2 text-gray-600 hover:underline">Cancelar</a>
        </form>
    </div>
</x-layouts.app>
