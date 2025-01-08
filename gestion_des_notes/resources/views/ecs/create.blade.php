@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Créer un EC</h1>
    <form action="{{ route('ecs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Code de l'EC</label>
            <input type="text" name="code" id="code" class="form-control" placeholder="Ex : MAT101" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'EC</label>
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Ex : Mathématiques" required>
        </div>
        <div class="mb-3">
            <label for="coefficient" class="form-label">Coefficient</label>
            <input type="number" name="coefficient" id="coefficient" class="form-control" placeholder="Ex : 3" required>
        </div>
        <div class="mb-3">
            <label for="ue_id" class="form-label">UE Associée</label>
            <select name="ue_id" id="ue_id" class="form-select" required>
                <option value="" disabled selected>Choisir une UE</option>
                @foreach ($ues as $ue)
                <option value="{{ $ue->id }}">{{ $ue->nom }} ({{ $ue->code }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="responsable_id" class="form-label">Responsable de l'EC</label>
            <select name="responsable_id" id="responsable_id" class="form-select">
                <option value="" disabled selected>Choisir un responsable</option>
                @foreach ($enseignants as $enseignant)
                <option value="{{ $enseignant->id }}">{{ $enseignant->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
