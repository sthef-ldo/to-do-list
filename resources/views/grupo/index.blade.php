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
                    {{-- Tarjeta completa clicable --}}
                    <a href="{{ route('tareas.index', ['grupo' => $grupo->id]) }}" class="block group">
                        <flux:card
                            class="space-y-4 p-6 min-h-50 bg-gray-800 border border-gray-700 rounded-md shadow-md hover:shadow-lg hover:border-indigo-500 transition-all cursor-pointer flex flex-col justify-between">

                            <!-- Parte superior: nombre e info -->
                            <div class="flex-1">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <h3 class="font-semibold text-xl text-white mb-1 truncate group-hover:text-indigo-400">
                                            {{ $grupo->nombre }}
                                        </h3>
                                        <p class="text-gray-500 text-xs">ID: {{ $grupo->id }}</p>
                                    </div>

                                    {{-- Dropdown de acciones --}}
                                    <div class="relative"
                                         onclick="event.stopPropagation(); event.preventDefault();">
                                        <div x-data="{ open: false }" class="relative">
                                            <button
                                                x-on:click="open = !open"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-gray-700 hover:bg-gray-600 text-gray-200 focus:outline-none shadow">
                                                <!-- ícono de tres puntos -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor"
                                                     class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm6 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm6 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                </svg>
                                            </button>

                                            <div
                                                x-show="open"
                                                x-on:click.outside="open = false"
                                                x-cloak
                                                class="absolute right-0 mt-2 w-40 bg-gray-900 border border-gray-700 rounded-md shadow-lg py-1 z-20">

                                                {{-- Editar --}}
                                                <flux:modal.trigger :name="'edit-grupo-'.$grupo->id">
                                                    <button
                                                        type="button"
                                                        class="w-full text-left px-3 py-2 text-sm text-gray-200 hover:bg-gray-800 flex items-center gap-2">
                                                        <x-icon name="pencil" class="w-4 h-4" />
                                                        <span>Editar</span>
                                                    </button>
                                                </flux:modal.trigger>

                                                {{-- Eliminar --}}
                                                <form action="{{ route('grupos.destroy', $grupo->id) }}"
                                                      method="POST"
                                                      class="w-full"
                                                      onclick="event.stopPropagation();">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="w-full text-left px-3 py-2 text-sm text-red-400 hover:bg-gray-800 flex items-center gap-2">
                                                        <x-icon name="trash" class="w-4 h-4" />
                                                        <span>Eliminar</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Info de tareas --}}
                                <p class="mt-19 text-gray-400 text-sm">
                                    Tareas: {{ $grupo->tareas->count() }} / {{ $grupo->tareas->where('estado', '1')->count() }}
                                </p>
                            </div>

                        </flux:card>
                    </a>
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
                <div class="flex gap-3 mt-3">
                    <flux:button type="submit" variant="primary">Crear grupo</flux:button>
                    <flux:button type="button" x-on:click="$store.modals.close('crear-grupo')">Cancelar</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

</x-layouts::admin>
