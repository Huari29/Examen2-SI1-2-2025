<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>
            
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Plataforma')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

             <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Gestion Académica')" class="grid">
                    <flux:navlist.item icon="home" :href="route('materias.index')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Gestionar Materias') }}</flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('grupos.index')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Gestionar Grupos') }}</flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('aulas.index')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Gestionar Aulas') }}</flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('detalle-horario.create')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Asignar Horaios') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Asistencia Docente')" class="grid">
                    <flux:navlist.item icon="home" :href="route('asistencia.create')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Registrar asistencia') }}</flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('asistencias.validar.index')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Validar asistencia') }}</flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('inconsistencias.docente')" :current="request()->routeIs('inconsistencias.docente')" wire:navigate><div class="flex items-center justify-between w-full"><span>{{ __('Resolver inconsistencias de asistencia docente') }}</span>@livewire('notificacion-inconsistencias')</div></flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('inconsistencias.admin')" :current="request()->routeIs('inconsistencias.admin')" wire:navigate><div class="flex items-center justify-between w-full"><span>{{ __('Resolver inconsistencias de asistencia admin') }}</span>@livewire('notificacion-inconsistencias')</div></flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Usuario Roles')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Registrar docentes y usuarios') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Reportes')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Generar reportes academicos y administrativos') }}</flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('revisar reportes de asistencia y carga horaria') }}</flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Generar informes finales de gestion') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Supervisión Académica')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Solicitar ajustes o auditoría académica') }}</flux:navlist.item>
                     <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Evaluar cumplimiento docente') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Consulta Docente')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Consultar horario asistente') }}</flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Consultar historial de asistencia') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>
            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/Huari29/Examen2-SI1-2-2025.git" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://docs.google.com/document/d/1OQb3urZriGdEFcljpQwxsg5vZ9fqAzib/edit?usp=sharing&ouid=107539514226809651841&rtpof=true&sd=true" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                    data-test="sidebar-menu-button"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        <flux:menu.item :href="route('logs.index')" icon="cog" wire:navigate>{{ __('Bitácora') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
