@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des Enseignants</h1>

    <!-- Bouton pour créer un nouvel enseignant -->
    <a href="{{ route('enseignants.create') }}" class="btn btn-primary mb-3">Ajouter un Enseignant</a>

    @if($enseignants->isEmpty())
        <p class="text-center">Aucun enseignant n'est enregistré pour le moment.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enseignants as $enseignant)
                <tr>
                    <td>{{ $enseignant->id }}</td>
                    <td>{{ $enseignant->nom }}</td>
                    <td>{{ $enseignant->prenom }}</td>
                    <td>{{ $enseignant->telephone }}</td>
                    <td>
                        <!-- Bouton de modification -->
                        <a href="{{ route('enseignants.edit', $enseignant->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                        <!-- Formulaire de suppression -->
                        <form action="{{ route('enseignants.destroy', $enseignant->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enseignant ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
