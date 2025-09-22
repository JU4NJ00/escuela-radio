<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Programa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Columna izquierda: Programa -->
                <div class="md:col-span-1">
                    <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            {{ $programa->nombre }}
                        </h3>

                        <p class="text-gray-600 mb-2">
                            <span class="font-semibold">Conductor:</span>
                            {{ $programa->conductor ?? '—' }}
                        </p>

                        <p class="text-gray-600 mb-2">
                            <span class="font-semibold">Descripción:</span>
                            {{ $programa->descripcion ?? 'Sin descripción' }}
                        </p>

                        @if($programa->imagen)
                            <div  class="my-4 overflow-hidden rounded-lg shadow-lg">
                                <img src="{{ asset('storage/' . $programa->imagen) }}"
                                    alt="{{ $programa->nombre }}"
                                    class="w-full h-60 object-cover transform transition duration-500 ease-in-out hover:scale-105 hover:brightness-110">
                            </div>
                        @endif

                        <p class="text-gray-500 text-sm mt-4">
                            Creado: {{ $programa->created_at?->format('d/m/Y H:i') ?? '—' }}
                        </p>
                    </div>
                </div>

                <!-- Columna derecha: Programaciones -->
                <div class="md:col-span-2">
                    <div class="bg-gray-50 shadow-inner rounded-xl p-6 border border-gray-200 h-full">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Programaciones asociadas
                        </h4>

                        @if($programa->programaciones->isEmpty())
                            <p class="text-gray-500 italic">Este programa aún no tiene horarios asignados.</p>
                        @else
                            <ul class="space-y-3">
                                @php
                                    $dias = [
                                        0 => 'Lunes',
                                        1 => 'Martes',
                                        2 => 'Miércoles',
                                        3 => 'Jueves',
                                        4 => 'Viernes',
                                        5 => 'Sábado',
                                        6 => 'Domingo',
                                    ];
                                @endphp
                                @foreach($programa->programaciones as $prog)
                                    <li class="flex items-center bg-white rounded-lg shadow p-4 border border-gray-200 hover:shadow-lg hover:border-blue-300 transition transform hover:-translate-y-1">
                                        <svg class="w-5 h-5 mr-3 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                        <div>
                                            <p class="text-gray-800 font-medium">
                                                {{ $dias[$prog->dia_semana] ?? '—' }}
                                            </p>
                                            <p class="text-gray-600 text-sm">
                                                {{ $prog->hora_inicio }} – {{ $prog->hora_fin }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Botón volver -->
            <div class="flex mt-8">
                <a href="{{ route('radio.programas.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Volver al listado
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
