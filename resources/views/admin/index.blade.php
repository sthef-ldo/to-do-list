<x-layouts::admin>

    {{-- Breadcrumbs con margen inferior --}}
    <div class="mb-8">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="dashboard">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Tareas</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    {{-- Card principal con espaciado interno controlado --}}
    <flux:card class="space-y-8">

        {{-- Header de la sección con mejor distribución --}}
        <div class="flex items-center justify-between gap-4 pb-6 border-b border-gray-200">
            <flux:heading size="md">Tareas</flux:heading>
            <flux:button href="{{ route('tareas.create') }}">Nueva Tarea</flux:button>

        </div>

        {{-- Tabla con espaciado consistente --}}
        <div class="overflow-x-auto">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column>Num</flux:table.column>
                    <flux:table.column>Tarea</flux:table.column>
                    <flux:table.column>Prioridad</flux:table.column>
                    <flux:table.column>Estado</flux:table.column>
                    <flux:table.column>F. Límite</flux:table.column>
                    <flux:table.column>Acciones</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>

                    @foreach ($tareas as $tarea)
                        <flux:table.row>

                            <flux:table.cell>{{ $tarea->id }}</flux:table.cell>
                            <flux:table.cell>{{ $tarea->tarea }}</flux:table.cell>
                            <flux:table.cell>{{ $tarea->prioridad }}</flux:table.cell>

                            <flux:table.cell>
                                <form action="{{ route('tareas.toggle', $tarea->id) }}" method="POST">
                                    @csrf
                                    <flux:button name="estado" size="sm"
                                        color="{{ $tarea->estado ? 'success' : 'gray' }}" type="submit">
                                        {{ $tarea->estado ? 'Terminado' : 'Sin terminar' }}
                                    </flux:button>
                                </form>
                            </flux:table.cell>

                            <flux:table.cell>{{ $tarea->fecha_vencimiento }}</flux:table.cell>
                            <flux:table.cell>
                                <flux:button.group class="gap-1">
                                    <flux:button icon="pencil-square" href="{{ route('tareas.edit', $tarea->id) }}">
                                    </flux:button>
                                    <flux:button icon="eye" href="{{ route('tareas.show', $tarea->id) }}">
                                    </flux:button>
                                    <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button icon="trash" type="submit" color="destructive"></flux:button>
                                    </form>


                                </flux:button.group>
                            </flux:table.cell>
                        </flux:table.row>
                    @endforeach

                </flux:table.rows>
            </flux:table>
        </div>
    </flux:card>



</x-layouts::admin>
