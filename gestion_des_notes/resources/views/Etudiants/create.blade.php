@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Créer un nouvel étudiant</h1>

        <form action="{{ route('etudiants.store') }}" method="POST">
            @csrf

            <!-- Numéro étudiant -->
            <div class="mb-4">
                <label for="numero_etudiant" class="block text-sm font-medium text-gray-700">Numéro étudiant</label>
                <input type="text" 
                       name="numero_etudiant" 
                       id="numero_etudiant" 
                       class="form-input mt-1 block w-full" 
                       required>
                @error('numero_etudiant')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" 
                       name="nom" 
                       id="nom" 
                       class="form-input mt-1 block w-full" 
                       required>
                @error('nom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" 
                       name="prenom" 
                       id="prenom" 
                       class="form-input mt-1 block w-full" 
                       required>
                @error('prenom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Niveau -->
            <div class="mb-4">
                <label for="niveau" class="block text-sm font-medium text-gray-700">Niveau</label>
                <select name="niveau" 
                        id="niveau" 
                        class="form-select mt-1 block w-full" 
                        required>
                    <option value="">-- Sélectionnez un niveau --</option>
                    <option value="L1">L1</option>
                    <option value="L2">L2</option>
                    <option value="L3">L3</option>
                </select>
                @error('niveau')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bouton soumettre -->
            <button type="submit" class="btn btn-primary">Créer l'étudiant</button>
        </form>
    </div>
@endsection
