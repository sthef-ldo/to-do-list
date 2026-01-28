<x-layouts::admin>

<p>aa</p>
    {{-- Breadcrumbs con margen inferior --}}
    <div class="mb-8">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Tareas</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    {{-- Card principal con espaciado interno controlado --}}
    <flux:card class="space-y-8">
        
        {{-- Header de la sección con mejor distribución --}}
        <div class="flex items-center justify-between gap-4 pb-6 border-b border-gray-200">
            <flux:heading size="md">Tareas</flux:heading>
            <flux:button>Nueva Tarea</flux:button>
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

                    @foreach ( $tareas as $tarea )
                    <flux:table.row>
                        <flux:table.cell>{{ $tarea->id }}</flux:table.cell>
                        <flux:table.cell>{{ $tarea->tarea }}</flux:table.cell>
                        <flux:table.cell>{{ $tarea->prioridad }}</flux:table.cell>
                        <flux:table.cell>{{ $tarea->estado }}</flux:table.cell>
                        <flux:table.cell>{{ $tarea->fecha_vencimiento }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:button.group class="gap-1">
                                <flux:button icon="pencil" size="sm"></flux:button>
                                <flux:button icon="eye" size="sm"></flux:button>
                                <flux:button icon="trash" size="sm" color="destructive"></flux:button>
                            </flux:button.group>
                        </flux:table.cell>
                    </flux:table.row>
                    @endforeach

                </flux:table.rows>
            </flux:table>
        </div>
    </flux:card>

</x-layouts::admin>
