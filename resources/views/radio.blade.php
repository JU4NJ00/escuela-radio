<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <!-- Título -->
        <h1 class="text-2xl font-semibold text-center text-gray-800 mb-8">
            📻 Radio en Vivo
        </h1>

        <!-- Player YouTube minimalista -->
        <div class="aspect-video w-full mb-10 rounded-lg overflow-hidden shadow">
            <iframe class="w-full h-full"
                src="https://www.youtube.com/embed/cb12KmMMDJA?autoplay=1"
                title="Radio en Vivo"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>

        <!-- Programación de Hoy -->
        <div class="bg-white border rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-medium text-gray-700 mb-4 text-center">
                📅 Programación de Hoy
            </h2>

            <!-- 🔽 Aquí iterarías la programación -->
            <!--
            {{-- @foreach($programasHoy as $programacion)
                <div class="flex justify-between items-center border-b py-2 last:border-0">
                    <div>
                        <p class="font-medium text-gray-800">
                            {{ $programacion->programa->nombre }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $programacion->programa->conductor ?? 'Conductor no definido' }}
                        </p>
                    </div>
                    <span class="text-sm text-gray-600">
                        {{ $programacion->hora_inicio }} – {{ $programacion->hora_fin }}
                    </span>
                </div>
            @endforeach --}}
            -->

            <!-- 🔽 Placeholder si aún no hay datos -->
            <p class="text-center text-gray-400 italic">
                La programación de hoy aparecerá aquí.
            </p>
        </div>
    </div>
</x-app-layout>
