@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">Panel de Administración</h1>
        <a href="{{ route('radio.programas.index') }}" class="px-4 py-2 rounded-full bg-lime-600 text-white">Ir a Programas</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold">Posteos</h3>
            <div class="text-3xl font-bold">{{ $counts['posteos'] }}</div>
            <a href="{{ route('posteo.index') }}" class="text-sm text-lime-600">Gestionar posteos →</a>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold">Programas</h3>
            <div class="text-3xl font-bold">{{ $counts['programas'] }}</div>
            <a href="{{ route('radio.programas.index') }}" class="text-sm text-lime-600">Gestionar programas →</a>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold">Programaciones</h3>
            <div class="text-3xl font-bold">{{ $counts['programaciones'] }}</div>
            <a href="{{ route('radio.programaciones.index') }}" class="text-sm text-lime-600">Gestionar programaciones →</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold mb-4">Últimos posteos</h3>
            <ul class="space-y-3">
                @foreach($ultimosPosteos as $posteo)
                    <li class="flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ $posteo->title ?? $posteo->titulo ?? 'Sin título' }}</div>
                            <div class="text-xs text-gray-500">{{ $posteo->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <a href="{{ route('posteo.edit', $posteo) }}" class="text-sm text-lime-600">Editar</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold mb-4">Últimos programas</h3>
            <ul class="space-y-3">
                @foreach($ultimosProgramas as $programa)
                    <li class="flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ $programa->nombre }}</div>
                            <div class="text-xs text-gray-500">Creado {{ $programa->created_at->format('d/m/Y') }}</div>
                        </div>
                        <a href="{{ route('radio.programas.edit', $programa) }}" class="text-sm text-lime-600">Editar</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
