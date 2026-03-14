@extends('layouts.app')
@section('title', 'Novo Técnico')
@section('titulo', 'Novo Técnico')

@section('content')
<div class="bg-white rounded shadow p-6 max-w-lg">
    <form method="POST" action="{{ route('tecnicos.store') }}">
        @csrf
        @include('tecnicos._form')
        <div class="flex gap-3 mt-6">
            <button class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Salvar</button>
            <a href="{{ route('tecnicos.index') }}" class="text-gray-600 hover:underline self-center">Voltar</a>
        </div>
    </form>
</div>
@endsection
