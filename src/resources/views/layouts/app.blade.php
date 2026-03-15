<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Chamados')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-indigo-700 text-white px-6 py-3 flex gap-6 items-center">
        <span class="font-bold text-lg">Sistema de Chamados</span>
        <a href="{{ route('chamados.index') }}" class="hover:underline">Chamados</a>
        <a href="{{ route('categorias.index') }}" class="hover:underline">Categorias</a>
        <a href="{{ route('tecnicos.index') }}" class="hover:underline">Técnicos</a>
    </nav>

    <main class="max-w-5xl mx-auto mt-8 px-4">
        <h1 class="border-l-8 border-indigo-600 pl-4 text-3xl font-bold text-gray-800 mb-6">
            @yield('titulo', 'Sistema de Chamados')
        </h1>

        @if(session('ok'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('ok') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
