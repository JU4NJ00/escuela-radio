<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Programa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
                        <p class="font-bold mb-2">{{ __('¡Ups! Hay algunos problemas con tu entrada:') }}</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('radio.programas.update', $programa) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Datos del programa -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Datos del Programa') }}</h3>

                            <div class="mb-4">
                                <label for="nombre" class="block font-medium text-sm text-gray-700">Nombre *</label>
                                <input type="text" name="nombre" id="nombre"
                                    value="{{ old('nombre', $programa->nombre) }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('nombre') border-red-500 @enderror">
                                @error('nombre')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="descripcion"
                                    class="block font-medium text-sm text-gray-700">Descripción</label>
                                <textarea name="descripcion" id="descripcion" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $programa->descripcion) }}</textarea>
                                @error('descripcion')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="conductor" class="block font-medium text-sm text-gray-700">Conductor</label>
                                <input type="text" name="conductor" id="conductor"
                                    value="{{ old('conductor', $programa->conductor) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('conductor') border-red-500 @enderror">
                                @error('conductor')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Imagen del Programa') }}</h3>

                            @if ($programa->imagen)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Imagen actual:</p>
                                    <img src="{{ asset('storage/' . $programa->imagen) }}"
                                        alt="{{ $programa->nombre }}"
                                        class="w-full h-48 object-cover rounded-md border shadow-sm mb-3">
                                    {{-- <div class="flex gap-2">
                                        <!-- Botón para eliminar imagen -->
                                        <form action="{{ route('radio.programas.destroyImage', $programa) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Eliminar la imagen actual?')"
                                                class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                                                🗑 Eliminar Imagen
                                            </button>
                                        </form>
                                    </div> --}}
                                </div>
                            @endif

                            <div class="mb-4">
                                <label for="imagen" class="block font-medium text-sm text-gray-700">Reemplazar
                                    Imagen</label>
                                <input type="file" name="imagen" id="imagen" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                    onchange="previewImage(this)">
                                @error('imagen')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <div id="image-preview" class="mt-2 hidden">
                                    <img id="preview" src="" alt="Vista previa"
                                        class="w-full h-48 object-cover rounded-md border border-gray-300 shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200" />

                    <!-- Programaciones -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Programaciones') }}</h3>

                        <div id="programaciones-container" class="space-y-3">
                            @foreach ($programa->programaciones as $i => $prog)
                                <input type="hidden" name="programaciones[{{ $i }}][id]"
                                    value="{{ $prog->id }}">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end border p-3 rounded-md">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">Día</label>
                                        <select name="programaciones[{{ $i }}][dia_semana]"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            @foreach ([0 => 'Lunes', 1 => 'Martes', 2 => 'Miércoles', 3 => 'Jueves', 4 => 'Viernes', 5 => 'Sábado', 6 => 'Domingo'] as $key => $dia)
                                                <option value="{{ $key }}"
                                                    {{ $prog->dia_semana == $key ? 'selected' : '' }}>
                                                    {{ $dia }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">Hora inicio</label>
                                        <input type="time" name="programaciones[{{ $i }}][hora_inicio]"
                                            value="{{ \Illuminate\Support\Str::of($prog->hora_inicio)->substr(0, 5) }}"
                                            step="60" class="...">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700">Hora fin</label>
                                        <input type="time" name="programaciones[{{ $i }}][hora_fin]"
                                            value="{{ \Illuminate\Support\Str::of($prog->hora_fin)->substr(0, 5) }}"
                                            step="60" class="...">
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button"
                                            class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700"
                                            onclick="removeProgramacion(this)">
                                            ✖ Eliminar
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" onclick="addProgramacion()"
                            class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            ➕ Agregar Programación
                        </button>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end space-x-3 mt-6">
                        <a href="{{ route('radio.programas.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            💾 Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>

    <script>
        function removeProgramacion(button) {
            button.closest('.grid').remove();
        }

        function addProgramacion() {
            const container = document.getElementById('programaciones-container');
            const index = container.children.length;

            const template = `
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end border p-3 rounded-md">
                <input type="hidden" name="programaciones[${index}][id]" value="">
                <div>
                    <label class="block text-sm text-gray-700">Día</label>
                    <select name="programaciones[${index}][dia_semana]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Seleccionar --</option>
                        <option value="0">Lunes</option>
                        <option value="1">Martes</option>
                        <option value="2">Miércoles</option>
                        <option value="3">Jueves</option>
                        <option value="4">Viernes</option>
                        <option value="5">Sábado</option>
                        <option value="6">Domingo</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Hora inicio</label>
                    <input type="time" name="programaciones[${index}][hora_inicio]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Hora fin</label>
                    <input type="time" name="programaciones[${index}][hora_fin]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-end">
                    <button type="button"
                        class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700"
                        onclick="removeProgramacion(this)">
                        ✖ Eliminar
                    </button>
                </div>
            </div>
        `;
            container.insertAdjacentHTML('beforeend', template);
        }
    </script>
</x-app-layout>
