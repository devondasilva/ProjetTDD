@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Modifier l'Enseignant</h1>
    <form action="{{ route('enseignants.update', $enseignant) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $enseignant->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $enseignant->prenom) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $enseignant->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $enseignant->telephone) }}">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Mettre à jour l'Enseignant</button>
        </div>
    </form>
</div>
@endsection
