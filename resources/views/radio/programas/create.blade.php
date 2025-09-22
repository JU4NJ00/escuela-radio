<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Programa con su Programación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('radio.programas.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Datos del Programa -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📻 Datos del Programa</h3>

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="conductor" class="block text-sm font-medium text-gray-700">Conductor</label>
                        <input type="text" name="conductor" id="conductor" value="{{ old('conductor') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen (opcional)</label>
                        <input type="file" name="imagen" id="imagen"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                               file:rounded-md file:border-0 file:text-sm file:font-semibold
                               file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <!-- Datos de la Programación -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Programación inicial</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="dia_semana" class="block text-sm font-medium text-gray-700">Día</label>
                            <select name="dia_semana" id="dia_semana"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
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
                            <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora inicio</label>
                            <input type="time" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="hora_fin" class="block text-sm font-medium text-gray-700">Hora fin</label>
                            <input type="time" name="hora_fin" id="hora_fin" value="{{ old('hora_fin') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Botón -->
                    <div class="flex justify-end">
                        <a href="{{ route('radio.programas.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 mr-2">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
