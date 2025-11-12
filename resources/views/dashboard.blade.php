<x-layouts.app :title="__('Bienvenido')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <Div>
                    <table class="border=1">
                        <thead>
                            <tr>
                                <td>{{__('Nombre')}}</td>
                                <td>{{__('Apellido')}}</td>
                                <td>{{__('Curso')}}</td>
                                <td>{{__('Turno')}}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{__('Cristian')}}</td>
                                <td>{{__('Huari')}}</td>
                                <td>{{__('6 Semestre')}}</td>
                                <td>{{__('mañana')}}</td>
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
