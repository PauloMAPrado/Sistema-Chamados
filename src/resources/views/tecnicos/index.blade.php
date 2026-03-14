@extends('layouts.app')
@section('title', 'Técnicos')
@section('titulo', 'Técnicos')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('tecnicos.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        + Novo Técnico
    </a>
</div>

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Nome</th>
                <th class="px-4 py-3 text-left">E-mail</th>
                <th class="px-4 py-3 text-left">Especialidade</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($tecnicos as $tecnico)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">{{ $tecnico->id }}</td>
                <td class="px-4 py-3 font-medium">{{ $tecnico->nome }}</td>
                <td class="px-4 py-3">{{ $tecnico->email }}</td>
                <td class="px-4 py-3">{{ $tecnico->especialidade }}</td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('tecnicos.edit', $tecnico) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form method="POST" action="{{ route('tecnicos.destroy', $tecnico) }}" onsubmit="return confirm('Remover este técnico?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Remover</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-6 text-center text-gray-400">Nenhum técnico cadastrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
