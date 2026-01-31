<x-layouts::admin :title="__('Dashboard')">

    <div class="p-6">
        <!-- Bienvenida -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-white">👋 ¡Bienvenido a tu Gestor de Tareas!</h1>
            <p class="text-gray-300 mt-2">
                Aquí podrás crear y organizar tus grupos de tareas fácilmente.
            </p>
        </div>

        <!-- Encabezado y botón crear -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-white">Grupos de tareas</h2>
            <flux:modal.trigger name="crear-grupo">
                <flux:button variant="primary">Crear grupo</flux:button>
            </flux:modal.trigger>
        </div>

        @if ($grupos->isEmpty())
            <!-- Sin grupos - Skeleton -->
            <flux:text class="mt-2 text-gray-400 italic mb-6">
                No se encuentra ningún grupo creado
            </flux:text>

            <flux:skeleton.group animate="shimmer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <flux:card
                    class="space-y-6 p-6 min-h-64 bg-gray-800 border border-gray-700 rounded-md shadow-md hover:shadow-lg transition-all">
                </flux:card>
                <flux:card
                    class="space-y-6 p-6 min-h-64 bg-gray-800 border border-gray-700 rounded-md shadow-md hover:shadow-lg transition-all">
                </flux:card>
                <flux:card
                    class="space-y-6 p-6 min-h-64 bg-gray-800 border border-gray-700 rounded-md shadow-md hover:shadow-lg transition-all">
                </flux:card>
            </flux:skeleton.group>
        @else
            <!-- Lista de grupos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($grupos as $grupo)
                    <flux:card
                        class="space-y-6 p-6 min-h-64 bg-gray-800 border border-gray-700 rounded-md shadow-md hover:shadow-lg transition-all">
                        <!-- Nombre del grupo -->
                        <div class="flex-1">
                            <h3 class="font-semibold text-xl text-white mb-2 truncate">{{ $grupo->nombre }}</h3>
                            <p class="text-gray-400 text-sm">ID: {{ $grupo->id }}</p>
                        </div>

                        <!-- Botones de acción -->
                        <div class="flex gap-2 pt-4 border-t border-gray-700">
                            <flux:modal.trigger :name="'edit-grupo-'.$grupo->id">
                                <flux:button size="sm" icon="pencil">Editar</flux:button>
                            </flux:modal.trigger>

                            <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <flux:button type="submit" size="sm" variant="danger" icon="trash">
                                    Eliminar
                                </flux:button>
                            </form>
                        </div>
                    </flux:card>
                @empty
                    <p class="col-span-full text-gray-400 text-center py-12">No tienes grupos creados aún.</p>
                @endforelse
            </div>

            <div class="mt-6 flex justify-center">
                {{ $grupos->links('pagination::tailwind') }}
            </div>

            {{-- TODOS los modales fuera del grid --}}
            @foreach ($grupos as $grupo)
                <flux:modal :name="'edit-grupo-'.$grupo->id" class="md:w-96">
                    <div class="space-y-6 p-6">
                        <h3 class="text-xl font-semibold text-white">Editar grupo</h3>
                        <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <flux:input label="Nombre del grupo" name="nombre" value="{{ $grupo->nombre }}" placeholder="Ej: Trabajo" class="w-full" />
                            <div class="flex gap-3 pt-4">
                                <flux:button type="submit" variant="primary">Guardar cambios</flux:button>
                                <flux:button type="button"
                                    x-on:click="$store.modals.close('edit-grupo-{{ $grupo->id }}')">Cancelar
                                </flux:button>
                            </div>
                        </form>
                    </div>
                </flux:modal>
            @endforeach

        @endif
    </div>

    {{-- Modal crear grupo --}}
    <flux:modal name="crear-grupo" class="md:w-96">
        <div class="space-y-6 p-6">
            <h3 class="text-xl font-semibold text-white">Nuevo grupo</h3>
            <form action="{{ route('grupos.store') }}" method="POST">
                @csrf
                <flux:input label="Nombre del grupo" name="nombre" placeholder="Ej: Trabajo, Personal, Proyectos..."
                    class="w-full" />
                <div class="flex gap-3">
                    <flux:button type="submit" variant="primary">Crear grupo</flux:button>
                    <flux:button type="button" x-on:click="$store.modals.close('crear-grupo')">Cancelar</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    
</x-layouts::admin>
