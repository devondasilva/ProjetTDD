@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Modifier un Enseignant</h1>

    <form action="{{ route('enseignants.update', $enseignant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input 
                type="text" 
                name="nom" 
                id="nom" 
                class="form-control" 
                value="{{ $enseignant->nom }}" 
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
                value="{{ $enseignant->prenom }}" 
                required>
        </div>

        <!-- Téléphone -->
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input 
                type="text" 
                name="telephone" 
                id="telephone" 
                class="form-control" 
                value="{{ $enseignant->telephone }}" 
                required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
