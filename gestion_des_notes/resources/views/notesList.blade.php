@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Tableau des Notes</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Étudiant</th>
                <th>EC</th>
                <th>Note</th>
                <th>Session</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>{{ $note->etudiant->nom }}</td>
                    <td>{{ $note->ec->nom }}</td>
                    <td>{{ $note->note }}</td>
                    <td>{{ ucfirst($note->session) }}</td>
                    <td>
                        <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
