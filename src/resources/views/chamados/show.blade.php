@extends('layouts.app')
@section('title', 'Chamado #' . $chamado->id)
@section('titulo', 'Chamado #' . $chamado->id)

@section('content')
<div class="bg-white rounded shadow p-6 max-w-2xl">
    <dl class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <dt class="font-medium text-gray-500">Título</dt>
            <dd class="mt-1 text-gray-900">{{ $chamado->titulo }}</dd>
        </div>
        <div>
            <dt class="font-medium text-gray-500">Status</dt>
            <dd class="mt-1 text-gray-900">{{ ucfirst($chamado->status) }}</dd>
        </div>
        <div>
            <dt class="font-medium text-gray-500">Prioridade</dt>
            <dd class="mt-1 text-gray-900">{{ ucfirst($chamado->prioridade) }}</dd>
        </div>
        <div>
            <dt class="font-medium text-gray-500">Data de Abertura</dt>
            <dd class="mt-1 text-gray-900">{{ $chamado->data_abertura }}</dd>
        </div>
        <div>
            <dt class="font-medium text-gray-500">Técnico</dt>
            <dd class="mt-1 text-gray-900">{{ $chamado->tecnico->nome ?? '-' }}</dd>
        </div>
        <div>
            <dt class="font-medium text-gray-500">Categoria</dt>
            <dd class="mt-1 text-gray-900">{{ $chamado->categoria->nome ?? '-' }}</dd>
        </div>
        <div class="col-span-2">
            <dt class="font-medium text-gray-500">Descrição</dt>
            <dd class="mt-1 text-gray-900 whitespace-pre-line">{{ $chamado->descricao }}</dd>
        </div>
    </dl>

    <div class="flex gap-3 mt-6">
        @can('attend', $chamado)
            @if($chamado->status === 'aberto')
                <form method="POST" action="{{ route('chamados.atender', $chamado) }}">
                    @csrf
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Iniciar atendimento</button>
                </form>
            @endif
        @endcan

        @can('resolve', $chamado)
            @if(in_array($chamado->status, ['aberto','em_atendimento']))
                <form method="POST" action="{{ route('chamados.resolver', $chamado) }}">
                    @csrf
                    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Marcar como resolvido</button>
                </form>
            @endif
        @endcan

        @can('close', $chamado)
            @if($chamado->status === 'resolvido')
                <form method="POST" action="{{ route('chamados.fechar', $chamado) }}">
                    @csrf
                    <button class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">Fechar</button>
                </form>
            @endif
        @endcan

        @can('update', $chamado)
            <a href="{{ route('chamados.edit', $chamado) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
        @endcan

        <a href="{{ route('chamados.index') }}" class="text-gray-600 hover:underline self-center">Voltar</a>
    </div>
</div>
@endsection
