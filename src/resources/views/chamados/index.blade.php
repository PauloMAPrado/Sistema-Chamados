@extends('layouts.app')
@section('title', 'Chamados')
@section('titulo', 'Chamados')

@section('content')
<div class="flex justify-end mb-4">
    <a href="{{ route('chamados.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        + Novo Chamado
    </a>
</div>

<form method="GET" class="flex gap-2 mb-4 items-end">
    <div>
        <label class="block text-xs text-gray-500">Prioridade</label>
        <select name="prioridade" class="mt-1 border rounded px-2 py-1 text-sm">
            <option value="">Todas</option>
            @foreach(['baixa','média','alta'] as $p)
                <option value="{{ $p }}" {{ request('prioridade') == $p ? 'selected' : '' }}>{{ ucfirst($p) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-xs text-gray-500">Status</label>
        <select name="status" class="mt-1 border rounded px-2 py-1 text-sm">
            <option value="">Todos</option>
            @foreach(['aberto','em_atendimento','resolvido','fechado'] as $s)
                <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ str_replace('_',' ', ucfirst($s)) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <button class="bg-gray-800 text-white px-3 py-1 rounded text-sm">Filtrar</button>
        <a href="{{ route('chamados.index') }}" class="ml-2 text-sm text-gray-600">Limpar</a>
    </div>
</form>
<div class="bg-white rounded shadow overflow-x-auto">
    @if(!request('status'))
        <div class="mb-3 text-sm text-gray-600">Observação: chamados com status <strong>fechado</strong> estão ocultos por padrão. Use o filtro de Status para exibi-los.</div>
    @endif

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
                <th class="px-4 py-3 text-left">Hora</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($chamados as $chamado)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">{{ $chamado->id }}</td>
                <td class="px-4 py-3 font-medium">{{ $chamado->titulo }}</td>
                <td class="px-4 py-3">
                    @if($chamado->prioridade == 'alta')
                        <span class="inline-block bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Alta</span>
                    @elseif($chamado->prioridade == 'média')
                        <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Média</span>
                    @else
                        <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Baixa</span>
                    @endif
                </td>
                <td class="px-4 py-3">{{ str_replace('_',' ', ucfirst($chamado->status)) }}</td>
                <td class="px-4 py-3">{{ $chamado->tecnico->nome ?? '-' }}</td>
                <td class="px-4 py-3">{{ $chamado->categoria->nome ?? '-' }}</td>
                <td class="px-4 py-3">{{ $chamado->data_abertura }}</td>
                <td class="px-4 py-3">
                    @if(method_exists($chamado, 'isAtrasado') && $chamado->isAtrasado())
                        <span class="inline-block bg-red-50 text-red-700 px-2 py-1 rounded text-xs">Atrasado</span>
                    @else
                        <span class="text-sm text-gray-500">-</span>
                    @endif
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('chamados.show', $chamado) }}" class="text-blue-600 hover:underline">Ver</a>

                    @can('update', $chamado)
                        <a href="{{ route('chamados.edit', $chamado) }}" class="text-yellow-600 hover:underline">Editar</a>
                        <form method="POST" action="{{ route('chamados.destroy', $chamado) }}" onsubmit="return confirm('Remover este chamado?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Remover</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="px-4 py-6 text-center text-gray-400">Nenhum chamado cadastrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $chamados->withQueryString()->links() }}
</div>
@endsection
