<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Listado de Posteos Escolares') }}
            </h2>
            <a href="{{ route('posteo.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nuevo Posteo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            @if ($posteos->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($posteos as $posteo)
                        <div x-data="{ showModal: false }" class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200 hover:shadow-2xl transition duration-300 ease-in-out flex flex-col">

                            <a href="{{ route('posteo.show', $posteo->slug) }}" class="block w-full aspect-[16/9] bg-gray-100 overflow-hidden">
                                @if ($posteo->imagen_destacada)
                                    <img src="{{ asset('storage/' . $posteo->imagen_destacada) }}"
                                        alt="{{ $posteo->titulo }}"
                                        class="w-full h-full object-cover transition-transform duration-500 ease-in-out hover:scale-110">
                                @else
                                    <img src="https://via.placeholder.com/640x360.png?text=Sin+Imagen" alt="Placeholder"
                                        class="w-full h-full object-cover opacity-80">
                                @endif
                            </a>

                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center space-x-2 mb-2">
                                        @php
                                            $estado_color = [
                                                'publicado' => 'bg-green-100 text-green-800',
                                                'borrador' => 'bg-gray-100 text-gray-800',
                                                'archivado' => 'bg-yellow-100 text-yellow-800',
                                            ][$posteo->estado] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $estado_color }} capitalize">
                                            {{ $posteo->estado }}
                                        </span>

                                        @if ($posteo->categoria_id)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $posteo->categoria->nombre ?? 'Sin Categoría' }}
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900 leading-tight line-clamp-2 mb-2">
                                        <a href="{{ route('posteo.show', $posteo->slug) }}" class="hover:text-blue-600 transition duration-150 ease-in-out">
                                            {{ $posteo->titulo }}
                                        </a>
                                    </h3>

                                    @if ($posteo->extracto)
                                        <p class="text-gray-600 text-sm line-clamp-3 mb-3">{{ $posteo->extracto }}</p>
                                    @endif

                                    @if (!empty($posteo->etiquetas))
                                        <div class="flex flex-wrap gap-1 mb-3">
                                            @foreach ($posteo->etiquetas as $etiqueta)
                                                <span class="inline-block bg-gray-200 rounded-full px-2 py-0.5 text-xs font-semibold text-gray-700">
                                                    {{ $etiqueta }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                    <div class="text-xs text-gray-500">
                                        Por <span class="font-semibold text-gray-700">{{ $posteo->usuario?->name ?? 'Anónimo' }}</span>
                                    </div>
                                    <div class="flex gap-2 text-sm">
                                        <!-- Botón Ver -->
                                        <a href="{{ route('posteo.show', $posteo->id) }}" title="Ver"
                                            class="p-2 text-gray-500 hover:text-green-600 transition duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <!-- Botón Editar -->
                                        <a href="{{ route('posteo.edit', $posteo->id) }}" title="Editar"
                                            class="p-2 text-gray-500 hover:text-blue-600 transition duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-7 1.5l2-2m-2 2l-2 2m4-2l2-2M15 7l3 3m0 0l-3 3m3-3h-4.5M16 5l-2 2m2-2l2 2m-2-2L14 3m0 0L12 5"></path>
                                            </svg>
                                        </a>
                                        <!-- Botón abrir modal -->
                                        <button @click="showModal = true" title="Eliminar"
                                            class="p-2 text-gray-500 hover:text-red-600 transition duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                <div class="bg-white rounded-lg shadow-lg w-96 p-6" @click.away="showModal = false">
                                    <h2 class="text-lg font-bold mb-4">Confirmar Eliminación</h2>
                                    <p class="mb-6 text-gray-600">¿Estás seguro de que quieres eliminar este posteo? Esta acción no se puede deshacer.</p>
                                    <div class="flex justify-end gap-3">
                                        <button @click="showModal = false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancelar</button>
                                        <form action="{{ route('posteo.destroy', $posteo->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $posteos->links() }}
                </div>
            @else
                <div class="text-center py-16 px-4 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                    <h3 class="mt-4 text-xl font-semibold text-gray-900">No hay posteos</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Comienza creando tu primer posteo para que aparezca aquí.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('posteo.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 transition ease-in-out duration-150">
                            Crear primer posteo
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
