@extends('layouts.app')
@section('title', 'Editar Categoria')
@section('titulo', 'Editar Categoria')

@section('content')
<div class="bg-white rounded shadow p-6 max-w-lg">
    <form method="POST" action="{{ route('categorias.update', $categoria) }}">
        @csrf @method('PUT')
        @include('categorias._form')
        <div class="flex gap-3 mt-6">
            <button class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Atualizar</button>
            <a href="{{ route('categorias.index') }}" class="text-gray-600 hover:underline self-center">Voltar</a>
        </div>
    </form>
</div>
@endsection
