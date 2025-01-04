<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Notes')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
             <!-- Logo dans la navbar -->
             <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('LOGO.png') }}" alt="Logo" class="d-inline-block align-top" height="40"> <!-- Vous pouvez ajuster la taille ici -->
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ues.index') }}">UEs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ecs.index') }}">ECs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notes.index') }}">Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('results.index') }}">Résultats</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>