@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Liste des ECs</h1>
    <a href="{{ route('ecs.create') }}" class="btn btn-primary mb-3">Ajouter un EC</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Coefficient</th>
                <th>UE</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ecs as $ec)
            <tr>
                <td>{{ $ec->code }}</td>
                <td>{{ $ec->nom }}</td>
                <td>{{ $ec->coefficient }}</td>
                <td>{{ $ec->ue->nom }} ({{ $ec->ue->code }})</td>
                <td>
                    <a href="{{ route('ecs.edit', $ec->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('ecs.destroy', $ec->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet EC ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
