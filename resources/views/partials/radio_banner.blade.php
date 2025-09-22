@php
    // Variables esperadas: $programacionesHoy, $programacionesManana, $actual, $now
    use Carbon\Carbon;

    // Inicializar valores por defecto si no fueron provistos por el controlador que incluyó la vista
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
@endphp

<div class="bg-white rounded-2xl shadow-xl overflow-hidden p-6 mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold text-gray-900">📻 Radio en Vivo</h3>
        <div class="text-sm text-gray-600">{{ $now->format('d/m/Y H:i') }} (ART)</div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="md:col-span-2">
            {{-- Reproductor: usar RADIO_STREAM_URL si está en .env; si no, mostrar placeholder --}}
            @php $stream = env('RADIO_STREAM_URL') ?? null; @endphp

            @if($stream)
                <div class="w-full rounded-lg overflow-hidden bg-gray-100 p-4">
                    <audio controls class="w-full">
                        <source src="{{ $stream }}" />
                        Tu navegador no soporta el elemento de audio.
                    </audio>
                    <div class="text-xs text-gray-500 mt-2">Si el audio no inicia, revisa la URL de stream en .env (RADIO_STREAM_URL).</div>
                </div>
            @else
                <div class="w-full aspect-video rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                    {{-- Reestablecer iframe de YouTube proporcionado por el usuario --}}
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/Uo-ziJhrTvI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            @endif
        </div>

        <div class="p-4 bg-gray-50 rounded-lg">
            <h4 class="font-semibold mb-2">Ahora al aire</h4>
            @if($actual)
                <div class="text-sm text-gray-800 font-medium">{{ optional($actual->programa)->nombre ?? '—' }}</div>
                <div class="text-xs text-gray-600">{{ $actual->hora_inicio }} - {{ $actual->hora_fin }}</div>
            @else
                <div class="text-sm text-gray-600">No hay programa en este momento</div>
            @endif

            <hr class="my-3">

            <h5 class="font-semibold text-sm mb-2">Hoy</h5>
            <div class="space-y-2 text-sm">
                @forelse($programacionesHoy as $ph)
                    <div class="flex justify-between">
                        <div>{{ optional($ph->programa)->nombre ?? '—' }}</div>
                        <div class="text-gray-600">{{ $ph->hora_inicio }} - {{ $ph->hora_fin }}</div>
                    </div>
                @empty
                    <div class="text-gray-500 text-sm">Sin programaciones para hoy</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
