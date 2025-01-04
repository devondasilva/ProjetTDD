@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Créer une nouvelle Unité d'Enseignement (UE)</h1>

        <form action="{{ route('ues.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700">Code de l'UE</label>
                <input type="text" name="code" id="code" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'UE</label>
                <input type="text" name="nom" id="nom" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="credits" class="block text-sm font-medium text-gray-700">Crédits (ECTS)</label>
                <input type="number" name="credits" id="credits" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="semestre" class="block text-sm font-medium text-gray-700">Semestre</label>
                <input type="number" name="semestre" id="semestre" class="form-input mt-1 block w-full" required>
            </div>

            <button type="submit" class="btn btn-primary">Créer l'UE</button>
        </form>
    </div>
@endsection
