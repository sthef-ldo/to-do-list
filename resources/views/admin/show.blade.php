<x-layouts::admin>

    {{-- Breadcrumbs con margen inferior --}}
    <div class="mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="dashboard">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('tareas.index') }}">Tareas</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Detalles</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <div class="max-w-3xl">
        <flux:card class="space-y-6">

            {{-- Encabezado principal --}}
            <div class="flex items-start justify-between gap-4">
                <div>
                    <flux:heading size="lg">{{ $tarea->tarea }}</flux:heading>
                    <flux:text class="mt-1 text-sm text-zinc-500">
                        Detalles y estado actual de la tarea.
                    </flux:text>
                </div>

                {{-- Estado como pill --}}
                <flux:badge
                    color="{{ $tarea->estado ? 'success' : 'zinc' }}"
                    size="sm"
                >
                    {{ $tarea->estado ? 'Terminado' : 'Sin terminar' }}
                </flux:badge>
            </div>

            {{-- Descripción --}}
            <div class="border-t border-zinc-200 dark:border-zinc-800 pt-4">
                <flux:heading size="sm" class="text-xs font-semibold tracking-wide text-zinc-500 uppercase">
                    Descripción
                </flux:heading>
                <flux:text class="mt-2 leading-relaxed">
                    {!! $tarea->descripcion !!}
                </flux:text>
            </div>

            {{-- Datos de la tarea en grid --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 border-t border-zinc-200 dark:border-zinc-800 pt-4">
                <div>
                    <flux:heading size="xs" class="text-xs font-semibold tracking-wide text-zinc-500 uppercase">
                        Prioridad
                    </flux:heading>
                    <flux:badge
                        class="mt-2"
                        color="@match($tarea->prioridad)
                            ('Alta' => 'danger',
                             'Media' => 'warning',
                             'Baja' => 'success',
                             default => 'zinc')
                        @endmatch"
                        size="sm"
                    >
                        {{ $tarea->prioridad }}
                    </flux:badge>
                </div>

                <div>
                    <flux:heading size="xs" class="text-xs font-semibold tracking-wide text-zinc-500 uppercase">
                        Fecha límite
                    </flux:heading>
                    <flux:text class="mt-2 text-sm">
                        {{ \Carbon\Carbon::parse($tarea->fecha_vencimiento)->format('d/m/Y') }}
                    </flux:text>
                </div>

                <div>
                    <flux:heading size="xs" class="text-xs font-semibold tracking-wide text-zinc-500 uppercase">
                        Estado
                    </flux:heading>
                    <flux:text class="mt-2 text-sm">
                        {{ $tarea->estado ? 'Completada' : 'Pendiente' }}
                    </flux:text>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="flex justify-end gap-3 border-t border-zinc-200 dark:border-zinc-800 pt-4">
                <flux:button
                    color="secondary"
                    href="{{ route('tareas.index') }}"
                    size="sm"
                >
                    Volver
                </flux:button>
            </div>

        </flux:card>
    </div>

</x-layouts::admin>
