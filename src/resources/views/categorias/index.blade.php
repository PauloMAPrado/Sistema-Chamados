@extends('layouts.app')
@section('title', 'Categorias')
@section('titulo', 'Categorias')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('categorias.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        + Nova Categoria
    </a>
</div>

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Nome</th>
                <th class="px-4 py-3 text-left">Hora</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categorias as $categoria)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">{{ $categoria->id }}</td>
                <td class="px-4 py-3 font-medium">{{ $categoria->nome }}</td>
                <td class="px-4 py-3">{{ $categoria->horas }}h</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('categorias.edit', $categoria) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('Remover esta categoria?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Remover</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-6 text-center text-gray-400">Nenhuma categoria cadastrada.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
