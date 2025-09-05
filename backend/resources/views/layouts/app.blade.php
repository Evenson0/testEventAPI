<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Event App')</title>
    <!-- Les fichiers CSS/JS peuvent être compilés via Vite ou Mix -->
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/') }}">Accueil</a>
            @auth
                <a href="{{ route('events.create') }}">Créer un événement</a>
            @endauth
        </nav>
    </header>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
