@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Modifier un EC</h1>
    <form action="{{ route('ecs.update', $ec->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Code de l'EC -->
        <div class="mb-3">
            <label for="code" class="form-label">Code de l'EC</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ $ec->code }}" required>
        </div>

        <!-- Nom de l'EC -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'EC</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $ec->nom }}" required>
        </div>

        <!-- Coefficient -->
        <div class="mb-3">
            <label for="coefficient" class="form-label">Coefficient</label>
            <input type="number" name="coefficient" id="coefficient" class="form-control" value="{{ $ec->coefficient }}" required>
        </div>

        <!-- UE Associée -->
        <div class="mb-3">
            <label for="ue_id" class="form-label">UE Associée</label>
            <select name="ue_id" id="ue_id" class="form-select" required>
                @foreach ($ues as $ue)
                <option value="{{ $ue->id }}" @if ($ue->id == $ec->ue_id) selected @endif>
                    {{ $ue->nom }} ({{ $ue->code }})
                </option>
                @endforeach
            </select>
        </div>

        <!-- Responsable (Enseignant) -->
        <div class="mb-3">
            <label for="responsable_id" class="form-label">Responsable (Enseignant)</label>
            <select name="responsable_id" id="responsable_id" class="form-select" required>
                <option value="">Sélectionner un enseignant</option>
                @foreach ($enseignants as $enseignant)
                <option value="{{ $enseignant->id }}" @if ($enseignant->id == $ec->responsable_id) selected @endif>
                    {{ $enseignant->nom }} {{ $enseignant->prenom }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
