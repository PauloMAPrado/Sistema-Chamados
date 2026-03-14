@extends('layouts.app')
@section('title', 'Chamados')
@section('titulo', 'Chamados')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('chamados.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        + Novo Chamado
    </a>
</div>

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Título</th>
                <th class="px-4 py-3 text-left">Prioridade</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Técnico</th>
                <th class="px-4 py-3 text-left">Categoria</th>
                <th class="px-4 py-3 text-left">Data</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($chamados as $chamado)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">{{ $chamado->id }}</td>
                <td class="px-4 py-3 font-medium">{{ $chamado->titulo }}</td>
                <td class="px-4 py-3">{{ ucfirst($chamado->prioridade) }}</td>
                <td class="px-4 py-3">{{ ucfirst($chamado->status) }}</td>
                <td class="px-4 py-3">{{ $chamado->tecnico->nome ?? '-' }}</td>
                <td class="px-4 py-3">{{ $chamado->categoria->nome ?? '-' }}</td>
                <td class="px-4 py-3">{{ $chamado->data_abertura }}</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('chamados.show', $chamado) }}" class="text-blue-600 hover:underline">Ver</a>
                    <a href="{{ route('chamados.edit', $chamado) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form method="POST" action="{{ route('chamados.destroy', $chamado) }}" onsubmit="return confirm('Remover este chamado?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Remover</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-4 py-6 text-center text-gray-400">Nenhum chamado cadastrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
