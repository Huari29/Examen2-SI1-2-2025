<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>

        {{-- 🔹 Notificación de éxito o error centrada --}}
        @if (session('success') || session('error'))
            <div class="flex justify-center mt-4">
                <div 
                    class="px-6 py-3 rounded-xl shadow-lg text-white font-medium transition-all duration-500
                           {{ session('success') ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}">
                    {{ session('success') ?? session('error') }}
                </div>
            </div>
        @endif

        {{ $slot }}

    </flux:main>
</x-layouts.app.sidebar>
