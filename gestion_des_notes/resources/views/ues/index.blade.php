@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des UEs</h1>
    <a href="{{ route('ues.create') }}" class="btn btn-primary mb-3">Créer une nouvelle UE</a>

    @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Crédits</th>
                <th>Semestre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ues as $ue)
            <tr>
                <td>{{ $ue->code }}</td>
                <td>{{ $ue->nom }}</td>
                <td>{{ $ue->credits }}</td>
                <td>{{ $ue->semestre }}</td>
                <td>
                    <a href="{{ route('ues.edit', $ue) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('ues.destroy', $ue) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette UE ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
