<div class="mt-6 text-center">
    <form action="{{ route('reportes.generar') }}" method="POST" class="inline-block">
        @csrf
        @foreach (request()->all() as $key => $value)
            @if (!in_array($key, ['_token']))
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach
        <button type="submit" name="exportar_pdf" value="1"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Exportar a PDF
        </button>
    </form>

    <form action="{{ route('reportes.generar') }}" method="POST" class="inline-block ml-2">
        @csrf
        @foreach (request()->all() as $key => $value)
            @if (!in_array($key, ['_token']))
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach
        <button type="submit" name="exportar_excel" value="1"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
            Exportar a Excel
        </button>
    </form>

    <form action="{{ route('reportes.generar') }}" method="POST" class="inline-block ml-2">
        @csrf
        @foreach (request()->all() as $key => $value)
            @if (!in_array($key, ['_token']))
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endforeach
        <button type="submit" name="exportar_word" value="1"
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">
            Exportar a Word
        </button>
    </form>
</div>
