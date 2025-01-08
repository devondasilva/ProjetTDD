@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Créer une nouvelle Unité d'Enseignement (UE)</h1>
    <form action="{{ route('ues.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="code" class="form-label">Code de l'UE</label>
            <input type="text" name="code" id="code" class="form-control" placeholder="Ex: UE01" required value="{{ old('code') }}">
            @error('code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'UE</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Ex: Science" required value="{{ old('nom') }}">
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="credits" class="form-label">Crédits (ECTS)</label>
            <input type="number" name="credits" id="credits" class="form-control" placeholder="Ex: 5" required value="{{ old('credits') }}" min="1">
            @error('credits')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="semestre" class="form-label">Semestre</label>
            <input type="number" name="semestre" id="semestre" class="form-control" placeholder="Ex: 1" required value="{{ old('semestre') }}" min="1" max="6">
            @error('semestre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Créer l'UE</button>
    </form>
</div>
@endsection
