@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Liste des Unités d'Enseignement (UEs)</h1>

        <a href="{{ route('ues.create') }}" class="btn btn-primary">Créer une nouvelle UE</a>

        @if(session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full mt-4 table-auto border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Code UE</th>
                    <th class="border px-4 py-2">Nom</th>
                    <th class="border px-4 py-2">Crédits (ECTS)</th>
                    <th class="border px-4 py-2">Semestre</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ues as $ue)
                    <tr>
                        <td class="border px-4 py-2">{{ $ue->code }}</td>
                        <td class="border px-4 py-2">{{ $ue->nom }}</td>
                        <td class="border px-4 py-2">{{ $ue->credits }}</td>
                        <td class="border px-4 py-2">{{ $ue->semestre }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('ues.edit', $ue) }}" class="text-blue-500">Modifier</a>
                            <form action="{{ route('ues.destroy', $ue) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
