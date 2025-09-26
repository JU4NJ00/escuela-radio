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


    {{-- Encabezado --}}
    <header class="bg-white py-2 mb-6 shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center gap-3">
            {{-- Logo a la izquierda --}}
            <img src="{{ asset('upload/logo_radio.jpeg') }}" alt="Logo Radio El Lucero" class="w-10 h-10 object-contain">

            {{-- Texto al lado --}}
            <div class="leading-tight">
                <h1 class="text-lg sm:text-xl font-bold tracking-tight">
                    <span class="text-red-600">Radio</span>
                    <span class="text-green-700"> FM 94.1 - El Lucero</span>
                </h1>
                <p class="text-gray-600 text-xs sm:text-sm">
                    Escuela N.º 952 "Domingo Faustino Sarmiento"
                </p>
            </div>
        </div>
    </header>

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




    {{-- Contenido principal --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Columna principal --}}
            <main class="lg:col-span-2 space-y-8">

                {{-- Transmisión en vivo --}}
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
                            <iframe class="w-full h-full" src="{{ $rawStream }}" title="Transmisión en vivo"
                                frameborder="0"
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

            </main>



            {{-- Sidebar SOLO si hay algo que mostrar --}}
            @if ($actual || $programacionesHoy->isNotEmpty() || $programacionesManana->isNotEmpty())
                <aside class="space-y-8 mb-2">
                    {{-- Programa actual --}}
                    <div class="bg-white p-6 border-l-4 border-green-600 shadow-sm">
                        <h3 class="text-xl font-bold mb-4 text-gray-800 flex items-center gap-2">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
                                        <p class="font-medium text-gray-900">
                                            {{ optional($ph->programa)->nombre ?? '—' }}</p>
                                        <p class="text-sm text-gray-500">{{ $ph->hora_inicio }} – {{ $ph->hora_fin }}
                                        </p>
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
                                        <p class="font-medium text-gray-900">
                                            {{ optional($pm->programa)->nombre ?? '—' }}</p>
                                        <p class="text-sm text-gray-500">{{ $pm->hora_inicio }} – {{ $pm->hora_fin }}
                                        </p>
                                    </div>
                                </li>
                            @empty
                                <li class="text-gray-500 text-sm">Sin programaciones para mañana</li>
                            @endforelse
                        </ul>
                    </div>
                </aside>
            @endif

        </div> <!-- Fin del grid principal -->

        {{-- Carrusel --}}
        @include('partials.carrusel')



        {{-- Últimas noticias --}}
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 border-b pb-4 mb-6">Últimas Noticias</h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Noticia principal --}}
                @if ($posteos->isNotEmpty())
                    @php $principal = $posteos->first(); @endphp
                    <article class="lg:col-span-2 bg-white border border-gray-200 shadow hover:shadow-md transition">
                        @if ($principal->imagen_destacada)
                            <div class="h-72 overflow-hidden relative">
                                <img src="{{ asset('storage/' . $principal->imagen_destacada) }}"
                                    alt="Imagen de {{ $principal->titulo }}" class="w-full h-full object-cover">
                                <span class="absolute top-3 left-3 bg-red-600 text-white text-xs px-2 py-1">
                                    {{ $principal->categoria ?? 'General' }}
                                </span>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="text-2xl font-bold text-gray-900 hover:text-green-600 transition">
                                <a href="{{ route('posteo.show', $principal->id) }}">
                                    {{ $principal->titulo }}
                                </a>
                            </h3>
                            <p class="mt-3 text-gray-600 line-clamp-3">
                                {!! Str::limit(strip_tags($principal->contenido), 160) !!}
                            </p>
                            <p class="mt-2 text-xs text-gray-500">
                                {{ $principal->created_at->translatedFormat('d F, Y') }}
                            </p>
                        </div>
                    </article>
                @endif

                {{-- Noticias secundarias --}}
                <div class="space-y-6">
                    @foreach ($posteos->skip(1)->take(4) as $posteo)
                        <article class="flex gap-4 bg-white border border-gray-200 shadow-sm hover:shadow transition">
                            @if ($posteo->imagen_destacada)
                                <div class="w-28 h-28 flex-shrink-0 overflow-hidden">
                                    <img src="{{ asset('storage/' . $posteo->imagen_destacada) }}"
                                        alt="Imagen de {{ $posteo->titulo }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div class="p-3 flex flex-col justify-between">
                                <h4
                                    class="text-lg font-semibold text-gray-800 hover:text-green-600 transition line-clamp-2">
                                    <a href="{{ route('posteo.show', $posteo->id) }}">{{ $posteo->titulo }}</a>
                                </h4>
                                <p class="text-xs text-gray-500">
                                    {{ $posteo->created_at->translatedFormat('d F, Y') }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>



        {{-- Historia --}}
        <section class="bg-white shadow p-6 border border-gray-200 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Un Poco de Historia</h2>
                <p class="text-gray-600 mb-3">
                    La radio escolar nació gracias a la iniciativa de la Asociación Cooperadora y los docentes de la
                    Escuela Nº 952.
                    Sus primeras transmisiones fueron en 1990, utilizando equipos caseros que distribuían la señal en un
                    radio de 12 km.
                </p>
                <p class="text-gray-600 mb-3">
                    La primera frecuencia fue 90.5 y, tras mejoras técnicas, se adquirió la 94.1 FM, que continúa hasta
                    hoy.
                    Desde siempre los alumnos fueron protagonistas, creando programas con información, música y eventos
                    escolares.
                </p>
                <p class="text-gray-600 mb-3">
                    En 2015 la radio obtuvo su propio espacio dentro de la institución, consolidándose como parte de la
                    vida escolar.
                </p>
            </div>
            <div>
                <img src="{{ asset('upload/estudio.jpeg') }}" alt="Logo FM El Lucero"
                    class="w-full h-auto rounded shadow">
            </div>
        </section>






    </div> <!-- Fin del contenido principal -->


    <script src="//unpkg.com/alpinejs" defer></script>
</body>
{{-- Footer --}}
@include('partials.footer')

</html>
