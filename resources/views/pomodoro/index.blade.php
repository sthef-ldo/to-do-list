<x-layouts::admin>
    <flux:text class="text-base" color="red">Esta area queda en desarrollo hasta nuevo aviso </flux:text>
    
    {{-- Skeleton loader --}}
    <flux:skeleton.group animate="shimmer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <flux:card class="space-y-6 p-6 min-h-64 bg-gray-800 border border-gray-700 rounded-md shadow-md hover:shadow-lg transition-all">
        </flux:card>
    </flux:skeleton.group>

    <flux:modal.trigger name="edit-profile">
        <flux:button>Seleccionar Grupo</flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-profile" class="md:w-96">
        <div class="space-y-6">
            {{-- Selector de grupo --}}
            <flux:select wire:model="selectedGrupo" placeholder="Elige un grupo...">
                @foreach ($grupos as $grupo)
                    <flux:select.option value="{{ $grupo->id }}">{{ $grupo->nombre }}</flux:select.option>
                @endforeach
            </flux:select>

            {{-- Tabla de Tareas --}}
          <flux:table>
                <flux:table.columns>
                    <flux:table.column>Nombre</flux:table.column>
                    <flux:table.column>Estado</flux:table.column>
                    <flux:table.column>Acción</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                     {{--  @forelse ($tareas as $tarea)
                        <flux:table.row>
                            <flux:table.cell>{{ $tarea->nombre }}</flux:table.cell>
                            <flux:table.cell>
                                <span class="px-2 py-1 rounded-full text-xs 
                                    {{ $tarea->estado == 'completada' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $tarea->estado ?? 'pendiente' }}
                                </span>
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:button variant="outline" size="sm" wire:click="completarTarea({{ $tarea->id }})">
                                    Terminar
                                </flux:button>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="3" class="text-center text-gray-500 py-8">
                                No hay tareas aún
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse--}}
                </flux:table.rows>
            </flux:table> 
        </div>
    </flux:modal>
</x-layouts::admin>
