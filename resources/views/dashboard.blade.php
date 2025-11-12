<x-layouts.app :title="__('Bienvenido')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <Div>
                    <table class="border border-gray-400 w-full text-center">
                        <thead class="border border-gray-400 w-full text-center">
                            <tr>
                                <td class="border border-gray-400 w-full text-center">{{__('Nombre')}}</td>
                                <td class="border border-gray-400 w-full text-center">{{__('Apellido')}}</td>
                                <td class="border border-gray-400 w-full text-center">{{__('Curso')}}</td>
                                <td class="border border-gray-400 w-full text-center">{{__('Turno')}}</td>
                            </tr>
                        </thead>
                        <tbody class="border border-gray-400 w-full text-center">
                            <tr>
                                <td class="border border-gray-400 w-full text-center">{{__('Cristian')}}</td>
                                <td class="border border-gray-400 w-full text-center">{{__('Huari')}}</td>
                                <td class="border border-gray-400 w-full text-center">{{__('6 Semestre')}}</td>
                                <td class="border border-gray-400 w-full text-center">{{__('mañana')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </Div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
</x-layouts.app>
