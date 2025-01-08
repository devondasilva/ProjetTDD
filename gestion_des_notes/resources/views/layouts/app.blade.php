<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Notes')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
             <!-- Logo dans la navbar -->
             <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('LOGO.png') }}" alt="Logo" class="d-inline-block align-top h-10" > <!-- Vous pouvez ajuster la taille ici -->
            </a>
            <div class="">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex">
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
                        <a class="nav-link" href="{{ route('resultats.index') }}">Résultats</a>
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
