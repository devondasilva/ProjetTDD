@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Saisir les Notes pour l'EC : {{ $ecs->nom }}</h1>

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('notes.store', $ecs->id) }}" method="POST">
        @csrf
        <div class="form-group">
            @foreach($etudiants as $etudiant)
                <div class="mb-3">
                    <label for="etudiant_{{ $etudiant->id }}" class="form-label">
                        {{ $etudiant->nom }} {{ $etudiant->prenom }}
                    </label>
                    <input
                        type="number"
                        name="notes[{{ $etudiant->id }}]"
                        id="etudiant_{{ $etudiant->id }}"
                        class="form-control"
                        min="0"
                        max="20"
                        placeholder="Note"
                        required
                        value="{{ old('notes.' . $etudiant->id) }}"
                    >
                    <!-- Optionally add custom validation message for each student -->
                    @error('notes.' . $etudiant->id)
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les Notes</button>
    </form>
</div>
@endsection
