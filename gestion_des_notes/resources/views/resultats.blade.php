@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Résultats des Étudiants</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Étudiant</th>
                <th>UE</th>
                <th>Moyenne</th>
                <th>Crédits Acquis</th>
                <th>Semestre Validé</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->etudiant->nom }}</td>
                    <td>{{ $result->ue->nom }}</td>
                    <td>{{ $result->moyenne }}</td>
                    <td>{{ $result->credits }}</td>
                    <td>{{ $result->valide ? 'Oui' : 'Non' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
