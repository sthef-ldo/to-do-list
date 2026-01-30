<x-layouts::admin>

    @push('css')
        <!-- Include stylesheet quill.js-->
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endpush


    {{-- Breadcrumbs con margen inferior --}}
    <div class="mb-8">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="dashboard">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('tareas.index') }}">Tareas</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#">Editar</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <form id="tarea-form" action="{{ route('tareas.update', $tarea->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>

            <flux:card class="space-y-8">
                <flux:input label="Tarea" type="text" name="tarea" value="{{ old('tarea', $tarea->tarea) }}" />

                <div>
                    <p class="font-medium text-sm mb-2 ">Contenido</p>

                    <!-- Editor Quill con altura fija y wire:ignore -->
                    <div id="editor" wire:ignore>{!! old('descripcion', $tarea->descripcion) !!}</div>

                    <!-- Campo oculto para enviar el contenido -->
                    <textarea name="descripcion" id="descripcion" style="display:none;">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                </div>

                <flux:select label="Prioridad" wire:model="industry" name="prioridad" placeholder="Prioridad...">
                    <flux:select.option :selected="old('prioridad', $tarea->prioridad) === 'sin_prioridad'"
                        value="sin_prioridad">Sin Prioridad</flux:select.option>
                    <flux:select.option :selected="old('prioridad', $tarea->prioridad) === 'baja'" value="baja">
                        Baja</flux:select.option>
                    <flux:select.option :selected="old('prioridad', $tarea->prioridad) === 'media'" value="media">
                        Media</flux:select.option>
                    <flux:select.option :selected="old('prioridad', $tarea->prioridad) === 'alta'" value="alta">
                        Alta</flux:select.option>
                </flux:select>

                <flux:input label="Fecha de Vencimiento" type="datetime-local" name="fecha_vencimiento"
                    value="{{ old('fecha_vencimiento', $tarea->fecha_vencimiento) }}" />

                <div class="mt-6 flex justify-end gap-4">
                    <flux:button type="submit" color="primary">Guardar Tarea</flux:button>
                    <flux:button type="reset" color="secondary">Cancelar</flux:button>
                </div>

            </flux:card>

        </div>
    </form>

    @push('js')
        <!-- Include the Quill library -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <!-- Initialize Quill editor y sincronizar con textarea al enviar -->
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                const quill = new Quill('#editor', { theme: 'snow' });

                const form = document.getElementById('tarea-form');
                if (form) {
                    form.addEventListener('submit', function () {
                        const descripcionField = document.getElementById('descripcion');
                        if (descripcionField) {
                            descripcionField.value = quill.root.innerHTML;
                        }
                    });
                }
            });
        </script>

        <!-- jQuery CDN (minified) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @endpush

</x-layouts::admin>