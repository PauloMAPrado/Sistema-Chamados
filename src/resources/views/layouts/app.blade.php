<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lista de Tarefas')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div>
        <header>
            <h1 class="border-l-8 border-indigo-600 pl-4 text-4xl font-bold text-gray-800">@yield('lista_de', 'Lista de Tarefas')</h1>
        </header>
    </div>

    @if(session('ok'))
    <div>
        {{ session('ok') }}
    </div>
    @endif

    @yield('content')
</body>

</html>