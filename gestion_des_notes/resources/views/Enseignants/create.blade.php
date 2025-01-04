@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Créer un Enseignant</h1>
    <form action="{{ route('enseignants.store') }}" method="POST">
        @csrf

        <!-- Nom -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input 
                type="text" 
                name="nom" 
                id="nom" 
                class="form-control" 
                placeholder="Entrez le nom de l'enseignant" 
                required>
        </div>

        <!-- Prénom -->
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input 
                type="text" 
                name="prenom" 
                id="prenom" 
                class="form-control" 
                placeholder="Entrez le prénom de l'enseignant" 
                required>
        </div>

        <!-- Téléphone -->
        <div class="mb-3">
            <label for="telephone" class="form-label">Numéro de téléphone</label>
            <input 
                type="text" 
                name="telephone" 
                id="telephone" 
                class="form-control" 
                placeholder="Entrez le numéro de téléphone" 
                required>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
