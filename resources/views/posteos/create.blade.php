<x-app-layout>
    <x-slot name="header">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Posteo') }}
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

                <form action="{{ route('posteo.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Contenido del Posteo') }}</h3>
                            <div class="mb-4">
                                <label for="titulo" class="block font-medium text-sm text-gray-700">Título *</label>
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('titulo') border-red-500 @enderror">
                                @error('titulo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="extracto" class="block font-medium text-sm text-gray-700">Extracto *</label>
                                <textarea name="extracto" id="extracto" rows="2" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('extracto') border-red-500 @enderror">{{ old('extracto') }}</textarea>
                                @error('extracto')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="contenido" class="block font-medium text-sm text-gray-700">Contenido *
                                    (Editor Visual)</label>
                                <textarea name="contenido" id="contenido" rows="6" class="mt-1 block w-full"
                                    placeholder="Escribe aquí el contenido completo de tu posteo, incluyendo títulos, imágenes, y videos.">{{ old('contenido') }}</textarea>
                                @error('contenido')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Metadatos y Configuración') }}
                            </h3>
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

                                <div id="image-preview" class="mt-2 hidden">
                                    <img id="preview" src="" alt="Vista previa de la imagen destacada"
                                        class="w-full h-auto object-cover rounded-md border border-gray-300 shadow-sm">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="categoria_id"
                                    class="block font-medium text-sm text-gray-700">Categoría</label>
                                <input type="text" name="categoria_id" id="categoria_id"
                                    value="{{ old('categoria_id') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('categoria_id') border-red-500 @enderror"
                                    placeholder="Ej: Noticias, Tutoriales, etc.">
                                @error('categoria_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="etiquetas" class="block font-medium text-sm text-gray-700">Etiquetas
                                    (separadas por comas)</label>
                                <input type="text" name="etiquetas" id="etiquetas" value="{{ old('etiquetas') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('etiquetas') border-red-500 @enderror">
                                @error('etiquetas')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="estado" class="block font-medium text-sm text-gray-700">Estado *</label>
                                <select name="estado" id="estado" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('estado') border-red-500 @enderror">
                                    <option value="borrador" {{ old('estado') == 'borrador' ? 'selected' : '' }}>
                                        Borrador</option>
                                    <option value="publicado" {{ old('estado') == 'publicado' ? 'selected' : '' }}>
                                        Publicado</option>
                                    <option value="archivado" {{ old('estado') == 'archivado' ? 'selected' : '' }}>
                                        Archivado</option>
                                </select>
                                @error('estado')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="fecha_publicacion" class="block font-medium text-sm text-gray-700">Fecha de
                                    Publicación</label>
                                <input type="datetime-local" name="fecha_publicacion" id="fecha_publicacion"
                                    value="{{ old('fecha_publicacion') }}"
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
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Crear Posteo
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
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

        ClassicEditor
            .create(document.querySelector('#contenido'), {
                toolbar: {
                    items: [
                        'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                        'blockQuote', 'insertTable', 'undo', 'redo', '|', 'mediaEmbed', 'imageUpload'
                    ]
                },
                simpleUpload: {
                    // Ahora la ruta coincide con la de web.php
                    uploadUrl: '{{ route('posteo.upload.image') }}',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>
