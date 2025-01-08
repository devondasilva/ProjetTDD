@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Modifier l'EC</h1>
    <form action="{{ route('ecs.update', $ec) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="code" class="form-label">Code de l'EC</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $ec->code) }}" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'EC</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $ec->nom) }}" required>
        </div>
        <div class="mb-3">
            <label for="coefficient" class="form-label">Coefficient</label>
            <input type="number" name="coefficient" id="coefficient" class="form-control" value="{{ old('coefficient', $ec->coefficient) }}" required>
        </div>
        <div class="mb-3">
            <label for="ue_id" class="form-label">UE Associée</label>
            <select name="ue_id" id="ue_id" class="form-select" required>
                @foreach ($ues as $ue)
                    <option value="{{ $ue->id }}" {{ $ue->id == old('ue_id', $ec->ue_id) ? 'selected' : '' }}>{{ $ue->nom }} ({{ $ue->code }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="responsable_id" class="form-label">Responsable de l'EC</label>
            <select name="responsable_id" id="responsable_id" class="form-select">
                <option value="" disabled selected>Choisir un responsable</option>
                @foreach ($enseignants as $enseignant)
                <option value="{{ $enseignant->id }}" {{ $enseignant->id == old('responsable_id', $ec->responsable_id) ? 'selected' : '' }}>{{ $enseignant->nom }} {{ $enseignant->prenom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Mettre à jour l'EC</button>
            <a href="{{ route('ecs.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
