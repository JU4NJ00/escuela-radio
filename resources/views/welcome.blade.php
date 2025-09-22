<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radio - Escuela 962 "Domingo Faustino Sarmiento"</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>

</head>

<body class="bg-gray-100 text-gray-900 antialiased">

    @php
        use Carbon\Carbon;

        if (!isset($now)) {
            $now = Carbon::now('America/Argentina/Buenos_Aires');
        }
        if (!isset($programacionesHoy) || !is_iterable($programacionesHoy)) {
            $programacionesHoy = collect();
        }
        if (!isset($programacionesManana) || !is_iterable($programacionesManana)) {
            $programacionesManana = collect();
        }
        if (!isset($actual)) {
            $actual = null;
        }
        if (!isset($posteos) || !is_iterable($posteos)) {
            $posteos = collect();
        }

        $rawStream = env('RADIO_STREAM_URL') ? trim(env('RADIO_STREAM_URL')) : null;
        $isYoutube = $rawStream && preg_match('/(youtube\.com|youtu\.be)/i', $rawStream);
        $isHttpOnHttps = $rawStream && Str::startsWith($rawStream, 'http://') && request()->isSecure();

        if ($isYoutube && str_contains($rawStream, 'watch?v=')) {
            $rawStream = str_replace('watch?v=', 'embed/', $rawStream);
        }
    @endphp

    {{-- Encabezado principal del blog --}}
    <header class="bg-white text-gray-900 py-6 mb-10 shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight">Radio Escolar |<span class="text-green-600"> El
                    Lucero</span></h1>
            <p class="mt-2 text-gray-600 text-lg">Escuela 962 "Domingo Faustino Sarmiento"</p>
        </div>
    </header>

    {{-- Contenido principal --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Columna principal de posteos y radio --}}
            <main class="lg:col-span-2 space-y-8">
                <section class="bg-white shadow-md p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-5 border-b pb-4">
                        <h2 class="text-2xl font-bold text-gray-800">📡 Transmisión en Vivo</h2>
                        <span class="text-sm text-gray-500">{{ $now->translatedFormat('l, d/m/Y') }}</span>
                    </div>

                    @if (!$rawStream)
                        <p class="text-sm text-gray-500 text-center py-4">
                            No hay stream configurado. Define <code>RADIO_STREAM_URL</code> en tu <code>.env</code>.
                        </p>
                    @elseif ($isYoutube)
                        <div class="w-full aspect-video border border-gray-300">
                            <iframe class="w-full h-full" src="{{ $rawStream }}"
                                title="Canal 4 San Cristóbal - Transmisión en vivo" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <div class="w-full border border-gray-300">
                            <audio id="radioPlayer" controls autoplay class="w-full p-2 bg-white" preload="none">
                                <source src="{{ $rawStream }}">
                                Tu navegador no soporta el elemento de audio.
                            </audio>
                        </div>
                        @if ($isHttpOnHttps)
                            <div class="mt-4 text-sm text-rose-700 bg-rose-50 border border-rose-200 p-3">
                                <strong>Advertencia:</strong> Contenido mixto bloqueado. Tu sitio está en HTTPS pero el
                                stream es HTTP. Considera usar un stream HTTPS.
                            </div>
                        @endif
                    @endif
                </section>


                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-6">Últimas Noticias</h2>

                    <div class="relative">
                        {{-- Contenedor del Carrusel --}}
                        <div id="noticias-carrusel"
                            class="flex overflow-hidden space-x-6 pb-4 -mx-4 px-4 sm:px-6 lg:px-8">
                            @forelse ($posteos as $posteo)
                                <article
                                    class="flex-none w-72 md:w-80 h-auto bg-white border border-gray-200 shadow-sm transition-all duration-200 hover:shadow-md">
                                    {{-- Contenedor de la imagen --}}
                                    @if ($posteo->imagen_destacada)
                                        <div class="w-full h-40 overflow-hidden relative">
                                            <img src="{{ asset('storage/' . $posteo->imagen_destacada) }}"
                                                alt="Imagen de {{ $posteo->titulo }}"
                                                class="w-full h-full object-cover">
                                            @if ($posteo->categoria)
                                                <span
                                                    class="absolute bottom-2 left-2 bg-red-600 text-white text-xs font-semibold px-2 py-1">
                                                    {{ $posteo->categoria }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    {{-- Contenido del texto --}}
                                    <div class="p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3
                                                    class="text-lg font-bold text-gray-800 hover:text-red-600 transition-colors duration-200 line-clamp-2">
                                                    <a href="#">{{ $posteo->titulo }}</a>
                                                </h3>
                                                <p class="text-gray-500 text-xs font-medium mt-1 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $posteo->created_at->translatedFormat('d F, Y') }}
                                                </p>
                                            </div>

                                            <!-- Botón Ver -->
                                            <a href="{{ route('posteo.show', $posteo->id) }}" title="Ver"
                                                class="p-2 text-gray-500 hover:text-green-600 transition duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="bg-white p-6 text-center text-gray-500 border border-gray-200 w-full">
                                    <p>No hay noticias disponibles en este momento.</p>
                                </div>
                            @endforelse
                        </div>

                        {{-- Botones de Navegación --}}
                        <button id="prevBtn"
                            class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 text-white p-2 rounded-full shadow-md z-10 transition-opacity duration-300 hover:bg-opacity-75 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button id="nextBtn"
                            class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 text-white p-2 rounded-full shadow-md z-10 transition-opacity duration-300 hover:bg-opacity-75 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                </section>

                {{-- Agrega este script al final de tu `body`, antes del cierre de la etiqueta --}}
                <script>
                    (function() {
                        const carousel = document.getElementById('noticias-carrusel');
                        const prevBtn = document.getElementById('prevBtn');
                        const nextBtn = document.getElementById('nextBtn');
                        const scrollStep = 300; // Puedes ajustar este valor

                        // Oculta los botones si no hay suficientes posteos para hacer scroll
                        if (carousel.scrollWidth <= carousel.clientWidth) {
                            prevBtn.style.display = 'none';
                            nextBtn.style.display = 'none';
                        }

                        nextBtn.addEventListener('click', () => {
                            carousel.scrollBy({
                                left: scrollStep,
                                behavior: 'smooth'
                            });
                        });

                        prevBtn.addEventListener('click', () => {
                            carousel.scrollBy({
                                left: -scrollStep,
                                behavior: 'smooth'
                            });
                        });

                        // Opcional: Ocultar/mostrar botones al llegar al inicio o final del scroll
                        carousel.addEventListener('scroll', () => {
                            if (carousel.scrollLeft === 0) {
                                prevBtn.classList.add('opacity-0');
                            } else {
                                prevBtn.classList.remove('opacity-0');
                            }

                            if (carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth) {
                                nextBtn.classList.add('opacity-0');
                            } else {
                                nextBtn.classList.remove('opacity-0');
                            }
                        });
                    })();
                </script>

            </main>

            {{-- Columna lateral (Sidebar) --}}
            <aside class="space-y-8">

                {{-- Programa actual --}}
                <div class="bg-white p-6 border-l-4 border-green-600 shadow-sm">
                    <h3 class="text-xl font-bold mb-4 text-gray-800 flex items-center gap-2">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Ahora al aire
                    </h3>
                    @if ($actual && $actual->programa)
                        <div class="flex flex-col items-center gap-4 text-center">
                            @if ($actual->programa->imagen)
                                <div class="w-24 h-24 overflow-hidden border border-gray-300">
                                    <img src="{{ asset('storage/' . $actual->programa->imagen) }}"
                                        alt="Imagen de {{ $actual->programa->nombre }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">{{ $actual->programa->nombre }}</h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $actual->hora_inicio }} –
                                    {{ $actual->hora_fin }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-center text-gray-500">No hay programa en este momento.</p>
                    @endif
                </div>

                {{-- Programación de Hoy --}}
                <div class="bg-white p-6 border border-gray-200 shadow-sm">
                    <h4 class="text-xl font-bold mb-4 text-gray-800 border-b pb-3">🗓️ Programación de Hoy</h4>
                    <ul class="space-y-4">
                        @forelse($programacionesHoy as $ph)
                            <li class="flex items-center gap-3">
                                @if (optional($ph->programa)->imagen)
                                    <div class="flex-shrink-0 w-12 h-12 overflow-hidden border border-gray-200">
                                        <img src="{{ asset('storage/' . $ph->programa->imagen) }}"
                                            alt="Imagen de {{ $ph->programa->nombre }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ optional($ph->programa)->nombre ?? '—' }}
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $ph->hora_inicio }} – {{ $ph->hora_fin }}</p>
                                </div>
                            </li>
                        @empty
                            <li class="text-gray-500 text-sm">Sin programaciones para hoy</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Programación de Mañana --}}
                <div class="bg-white p-6 border border-gray-200 shadow-sm">
                    <h4 class="text-xl font-bold mb-4 text-gray-800 border-b pb-3">🗓️ Programación de Mañana</h4>
                    <ul class="space-y-4">
                        @forelse($programacionesManana as $pm)
                            <li class="flex items-center gap-3">
                                @if (optional($pm->programa)->imagen)
                                    <div class="flex-shrink-0 w-12 h-12 overflow-hidden border border-gray-200">
                                        <img src="{{ asset('storage/' . $pm->programa->imagen) }}"
                                            alt="Imagen de {{ $pm->programa->nombre }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ optional($pm->programa)->nombre ?? '—' }}
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $pm->hora_inicio }} – {{ $pm->hora_fin }}</p>
                                </div>
                            </li>
                        @empty
                            <li class="text-gray-500 text-sm">Sin programaciones para mañana</li>
                        @endforelse
                    </ul>
                </div>
            </aside>





        </div>


    </div>


    {{-- Aquí se incluye el footer --}}
    @include('partials.footer')


</body>

</html>
