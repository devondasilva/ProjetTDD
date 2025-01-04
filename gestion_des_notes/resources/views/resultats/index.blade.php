@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Résultats des Étudiants</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Total des Crédits ECTS</th>
                <th>Passage à l'Année Suivante</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultats as $resultat)
                <tr>
                    <td>{{ $resultat['etudiant']->nom }}</td>
                    <td>{{ $resultat['etudiant']->prenom }}</td>
                    <td>{{ $resultat['totalCredits'] }}</td>
                    <td>
                        @if($resultat['peutPasser'])
                            <span class="text-success">Oui</span>
                        @else
                            <span class="text-danger">Non</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
