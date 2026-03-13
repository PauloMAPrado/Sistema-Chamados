@extends('layouts.app')
@section('title', 'Nova tarefa')

@section('content')
<div>
    <form method="POST" action="{{ route('tarefas.store') }}">
        @csrf
        @include('tarefas._form')
        <div>
            <button class="rounded-lg border-2 bg-indigo-600 px-8 text-white font-bold uppercase">Salvar</button>
            <a href="{{ route('tarefas.index') }}">Voltar</a>
        </div>
    </form>
</div>
@endsection