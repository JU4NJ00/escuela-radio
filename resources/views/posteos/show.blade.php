<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Posteo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">

                {{-- Imagen destacada --}}
                @if ($posteo->imagen_destacada)
                    <div class="w-full h-80 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $posteo->imagen_destacada) }}"
                             alt="Imagen destacada de {{ $posteo->titulo }}"
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-75"></div>
                    </div>
                @endif

                {{-- Contenido --}}
                <div class="p-8">
                    {{-- Título y metadatos --}}
                    <div class="mb-6">
                        <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-2">
                            {{ $posteo->titulo }}
                        </h1>

                        <p class="text-sm text-gray-500 font-medium">
                            Por
                            <a href="#" class="text-blue-600 hover:underline">
                                {{ optional($posteo->usuario)->name ?? 'Anónimo' }}
                            </a>
                            en
                            <span class="font-bold text-gray-700">
                                {{ $posteo->categoria ?? 'Sin categoría' }}
                            </span>
                            <span class="mx-2">•</span>
                            <time datetime="{{ $posteo->fecha_publicacion?->format('Y-m-d\TH:i') ?? $posteo->created_at?->format('Y-m-d\TH:i') }}">
                                {{ $posteo->fecha_publicacion?->diffForHumans() ?? $posteo->created_at?->diffForHumans() }}
                            </time>
                        </p>
                    </div>

                    {{-- Extracto --}}
                    @if ($posteo->extracto)
                        <blockquote class="mb-6 p-4 border-l-4 border-blue-500 bg-gray-50 text-gray-600 italic">
                            {{ $posteo->extracto }}
                        </blockquote>
                    @endif

                    {{-- Contenido principal --}}
                    <div class="prose max-w-none text-gray-800 leading-relaxed mb-6">
                        <p>{{ $posteo->contenido }}</p>
                    </div>

                    {{-- Etiquetas --}}
                    @if ($posteo->etiquetas && count($posteo->etiquetas) > 0)
                        <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-200">
                            @foreach ($posteo->etiquetas as $etiqueta)
                                <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full text-blue-700 bg-blue-100">
                                    {{ trim($etiqueta) }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Botón de regreso --}}
            <div class="mt-8 text-center">
                <a href="{{ route('posteo.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-full shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a la lista de posteos
                </a>
            </div>
        </article>
    </div>
</x-app-layout>
