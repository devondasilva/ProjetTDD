@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="text-color border-l-indigo-800">Gestion des Notes - Système LMD</h1>
    <p class="lead">Bienvenue dans votre application de gestion des notes.</p>
    <div class="mt-4">
        <a href="{{ route('ues.index') }}" class="btn btn-primary btn-lg">Gérer les UEs</a>
        <a href="{{ route('ecs.index') }}" class="btn btn-primary btn-lg">Gérer les ECs</a>
        <a href="{{ route('notes.create') }}" class="btn btn-primary btn-lg">Saisir les Notes</a>
        <a href="{{ route('resultats.index') }}" class="btn btn-primary btn-lg">Consulter les Résultats</a>

    </div>
</div>
@endsection
