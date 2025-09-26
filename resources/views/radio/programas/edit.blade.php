<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Programa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">

                {{-- Errores --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulario --}}
                <form action="{{ route('radio.programas.update', $programa) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Datos del Programa -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📻 Datos del Programa</h3>

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre *</label>
                        <input type="text" name="nombre" id="nombre"
                            value="{{ old('nombre', $programa->nombre) }}" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="conductor" class="block text-sm font-medium text-gray-700">Conductor</label>
                        <input type="text" name="conductor" id="conductor"
                            value="{{ old('conductor', $programa->conductor) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('descripcion', $programa->descripcion) }}</textarea>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-6">
                        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen del
                            Programa</label>

                        @if ($programa->imagen)
                            <div class="mb-3">
                                <p class="text-sm text-gray-600">Imagen actual:</p>
                                <img src="{{ asset('storage/' . $programa->imagen) }}" alt="{{ $programa->nombre }}"
                                    class="w-full h-48 object-cover rounded-md border shadow-sm mt-2">
                            </div>
                        @endif

                        <input type="file" name="imagen" id="imagen" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                               file:rounded-md file:border-0 file:text-sm file:font-semibold
                               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <!-- Programaciones -->
                    <h3 class="text-lg font-semibold text-white mb-4">Programaciones</h3>

                    <div id="programaciones-container" class="space-y-4">
                        @foreach ($programa->programaciones as $i => $prog)
                            <input type="hidden" name="programaciones[{{ $i }}][id]"
                                value="{{ $prog->id }}">
                            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 p-3 rounded-md bg-white-50">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Día</label>
                                    <select name="programaciones[{{ $i }}][dia_semana]"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @foreach ([0 => 'Lunes', 1 => 'Martes', 2 => 'Miércoles', 3 => 'Jueves', 4 => 'Viernes', 5 => 'Sábado', 6 => 'Domingo'] as $key => $dia)
                                            <option value="{{ $key }}"
                                                {{ $prog->dia_semana == $key ? 'selected' : '' }}>
                                                {{ $dia }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Hora inicio</label>
                                    <input type="time" name="programaciones[{{ $i }}][hora_inicio]"
                                        value="{{ \Illuminate\Support\Str::of($prog->hora_inicio)->substr(0, 5) }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Hora fin</label>
                                    <input type="time" name="programaciones[{{ $i }}][hora_fin]"
                                        value="{{ \Illuminate\Support\Str::of($prog->hora_fin)->substr(0, 5) }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div class="flex items-end">
                                    <button type="button" onclick="removeProgramacion(this)"
                                        class="px-4 py-2 text-red-600 border border-red-500/50 rounded-md text-sm font-medium
               bg-transparent
               hover:bg-red-600 hover:text-white hover:border-red-600
               focus:outline-none focus:ring-2 focus:ring-red-400/50
               transition-all duration-300 ease-in-out">
                                        Eliminar
                                    </button>
                                </div>


                            </div>
                        @endforeach
                    </div>

                    <button type="button" onclick="addProgramacion()"
                        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Agregar Programación
                    </button>

                    <!-- Botones -->
                    <div class="flex justify-end mt-6 space-x-3">
                        <a href="{{ route('radio.programas.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Guardar Cambios
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function removeProgramacion(button) {
            button.closest('.grid').remove();
        }

        function addProgramacion() {
            const container = document.getElementById('programaciones-container');
            const index = container.children.length;

            const template = `
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 p-3 rounded-md">
                <input type="hidden" name="programaciones[${index}][id]" value="">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Día</label>
                    <select name="programaciones[${index}][dia_semana]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                               focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
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
                    <label class="block text-sm font-medium text-gray-700">Hora inicio</label>
                    <input type="time" name="programaciones[${index}][hora_inicio]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                               focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Hora fin</label>
                    <input type="time" name="programaciones[${index}][hora_fin]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                               focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div class="flex items-end">
                    <button type="button" onclick="removeProgramacion(this)"
                        class="px-4 py-2 text-red-600 border border-red-500/50 rounded-md text-sm font-medium
                               bg-transparent hover:bg-red-600 hover:text-white hover:border-red-600
                               focus:outline-none focus:ring-2 focus:ring-red-400/50
                               transition-all duration-300 ease-in-out">
                        Eliminar
                    </button>
                </div>
            </div>
        `;

            container.insertAdjacentHTML('beforeend', template);
        }
    </script>

</x-app-layout>
