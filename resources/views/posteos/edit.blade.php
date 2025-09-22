<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Posteo: ') }}<span class="font-bold">{{ $posteo->titulo }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

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

                <form action="{{ route('posteo.update', $posteo->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Importante para indicar que es una actualización --}}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Contenido del Posteo') }}</h3>
                            <div class="mb-4">
                                <label for="titulo" class="block font-medium text-sm text-gray-700">Título *</label>
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $posteo->titulo) }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('titulo') border-red-500 @enderror">
                                @error('titulo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="extracto" class="block font-medium text-sm text-gray-700">Extracto *</label>
                                <textarea name="extracto" id="extracto" rows="2" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('extracto') border-red-500 @enderror">{{ old('extracto', $posteo->extracto) }}</textarea>
                                @error('extracto')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="contenido" class="block font-medium text-sm text-gray-700">Contenido *</label>
                                <textarea name="contenido" id="contenido" rows="6" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('contenido') border-red-500 @enderror">{{ old('contenido', $posteo->contenido) }}</textarea>
                                @error('contenido')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Metadatos y Configuración') }}</h3>
                            <div class="mb-4">
                                <label for="imagen_destacada" class="block font-medium text-sm text-gray-700">
                                    Imagen Destacada
                                </label>
                                <input type="file" name="imagen_destacada" id="imagen_destacada" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                    onchange="previewImage(this)">

                                @error('imagen_destacada')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <div id="image-preview" class="mt-2 @unless($posteo->imagen_destacada) hidden @endunless">
                                    <img id="preview"
                                        src="{{ $posteo->imagen_destacada ? asset('storage/' . $posteo->imagen_destacada) : '' }}"
                                        alt="Vista previa de la imagen destacada"
                                        class="w-full h-auto object-cover rounded-md border border-gray-300 shadow-sm">
                                </div>

                                @if ($posteo->imagen_destacada)
                                    <div class="mt-2">
                                        <button type="button" id="remove-image-button"
                                            class="inline-flex items-center px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded-md hover:bg-red-600 transition duration-150 ease-in-out">
                                            Eliminar Imagen Actual
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label for="categoria_id" class="block font-medium text-sm text-gray-700">Categoría</label>
                                <input type="text" name="categoria_id" id="categoria_id" value="{{ old('categoria_id', $posteo->categoria_id) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('categoria_id') border-red-500 @enderror"
                                    placeholder="Ej: Noticias, Tutoriales, etc.">
                                @error('categoria_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="etiquetas" class="block font-medium text-sm text-gray-700">Etiquetas (separadas por comas)</label>
                                <input type="text" name="etiquetas" id="etiquetas" value="{{ old('etiquetas', implode(', ', (array) $posteo->etiquetas)) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('etiquetas') border-red-500 @enderror">
                                @error('etiquetas')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="estado" class="block font-medium text-sm text-gray-700">Estado *</label>
                                <select name="estado" id="estado" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('estado') border-red-500 @enderror">
                                    <option value="borrador" {{ old('estado', $posteo->estado) == 'borrador' ? 'selected' : '' }}>Borrador</option>
                                    <option value="publicado" {{ old('estado', $posteo->estado) == 'publicado' ? 'selected' : '' }}>Publicado</option>
                                    <option value="archivado" {{ old('estado', $posteo->estado) == 'archivado' ? 'selected' : '' }}>Archivado</option>
                                </select>
                                @error('estado')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="fecha_publicacion" class="block font-medium text-sm text-gray-700">Fecha de Publicación</label>
                                <input type="datetime-local" name="fecha_publicacion" id="fecha_publicacion"
                                    value="{{ old('fecha_publicacion', $posteo->fecha_publicacion ? $posteo->fecha_publicacion->format('Y-m-d\TH:i') : '') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('fecha_publicacion') border-red-500 @enderror">
                                @error('fecha_publicacion')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <hr class="my-6 border-gray-200" />

                    <div class="flex justify-end space-x-3 mt-6">
                        <a href="{{ route('posteo.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v8m18-8v8a2 2 0 01-2 2H8m4-4h.01M9 16h.01M16 16h.01M19 7h-5m-7-3V4"></path>
                            </svg>
                            Actualizar Posteo
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        /**
         * Muestra una vista previa de la imagen seleccionada por el usuario.
         * También inicializa la vista previa si ya hay una imagen cargada.
         * @param {HTMLInputElement} input - El elemento input de tipo file.
         */
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('image-preview');
            const removeButton = document.getElementById('remove-image-button');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    if (removeButton) removeButton.classList.add('hidden'); // Oculta el botón de eliminar si se sube una nueva
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                // Si no hay archivo nuevo y no hay imagen actual, oculta la previsualización
                // Comprobamos si no hay src o si es un placeholder genérico
                if (!preview.src || preview.src.includes('placeholder') || preview.src === window.location.href) {
                     previewContainer.classList.add('hidden');
                }
                if (removeButton) removeButton.classList.remove('hidden'); // Muestra el botón de eliminar si no hay nuevo archivo
            }
        }

        // Script para manejar la eliminación de la imagen destacada
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar la previsualización si hay una imagen existente
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('image-preview');
            if (preview.src && preview.src !== window.location.href) { // Verifica si ya hay una imagen cargada
                previewContainer.classList.remove('hidden');
            }

            const removeButton = document.getElementById('remove-image-button');
            if (removeButton) {
                removeButton.addEventListener('click', function() {
                    if (confirm('¿Estás seguro de que quieres eliminar la imagen destacada?')) {
                        // Crea un input hidden para indicar al controlador que la imagen debe ser eliminada
                        const form = document.querySelector('form');
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'remove_imagen_destacada';
                        hiddenInput.value = '1';
                        form.appendChild(hiddenInput);

                        // Oculta la imagen y el botón de eliminar
                        document.getElementById('image-preview').classList.add('hidden');
                        document.getElementById('preview').src = ''; // Limpia el src
                        removeButton.classList.add('hidden');

                        // Opcional: Resetea el input file para que no intente subir un archivo vacío
                        document.getElementById('imagen_destacada').value = '';
                    }
                });
            }
        });
    </script>
</x-app-layout>
