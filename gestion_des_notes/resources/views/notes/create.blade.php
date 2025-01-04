@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Créer une nouvelle note</h1>

        <form action="{{ route('notes.store') }}" method="POST">
            @csrf

            <!-- Sélection de l'étudiant -->
            <div class="mb-4">
                <label for="etudiant_id" class="block text-sm font-medium text-gray-700">Étudiant</label>
                <select name="etudiant_id" id="etudiant_id" class="form-select mt-1 block w-full" required>
                    <option value="">Sélectionner un étudiant</option>
                    @foreach($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}">{{ $etudiant->nom }} {{ $etudiant->prenom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélection de l'EC -->
            <div class="mb-4">
                <label for="ec_id" class="block text-sm font-medium text-gray-700">Élément Constitutif (EC)</label>
                <select name="ec_id" id="ec_id" class="form-select mt-1 block w-full" required>
                    <option value="">Sélectionner un EC</option>
                    @foreach($ecs as $ec)
                        <option value="{{ $ec->id }}">{{ $ec->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Note -->
            <div class="mb-4">
                <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                <input type="number" name="note" id="note" class="form-input mt-1 block w-full" step="0.01" required>
            </div>

            <!-- Session -->
            <div class="mb-4">
                <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
                <select name="session" id="session" class="form-select mt-1 block w-full" required>
                    <option value="normale">Normale</option>
                    <option value="rattrapage">Rattrapage</option>
                </select>
            </div>

            <!-- Date d'évaluation -->
            <div class="mb-4">
                <label for="date_evaluation" class="block text-sm font-medium text-gray-700">Date d'évaluation</label>
                <input type="date" name="date_evaluation" id="date_evaluation" class="form-input mt-1 block w-full" required>
            </div>

            <button type="submit" class="btn btn-primary">Créer la note</button>
        </form>
    </div>
@endsection
