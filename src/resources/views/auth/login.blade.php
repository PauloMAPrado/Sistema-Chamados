@extends('layouts.app')
@section('title', 'Login')
@section('titulo', 'Login')

@section('content')
<div class="bg-white rounded shadow p-6 max-w-md mx-auto">
    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Senha</label>
            <input type="password" name="password" class="mt-1 w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between mt-6">
            <div>
                <label class="inline-flex items-center text-sm">
                    <input type="checkbox" name="remember" class="mr-2">
                    Lembrar-me
                </label>
            </div>

            <div>
                <button class="bg-indigo-600 text-white px-4 py-2 rounded">Entrar</button>
            </div>
        </div>
    </form>
</div>
@endsection
