@extends('layouts.app')
@section('title', 'Editar Chamado')
@section('titulo', 'Editar Chamado')

@section('content')
<div class="bg-white rounded shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('chamados.update', $chamado) }}">
        @csrf @method('PUT')
        @include('chamados._form')
        <div class="flex gap-3 mt-6">
            <button class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Atualizar</button>
            <a href="{{ route('chamados.index') }}" class="text-gray-600 hover:underline self-center">Voltar</a>
        </div>
    </form>
</div>
@endsection
