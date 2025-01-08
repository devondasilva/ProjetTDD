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

    <!-- Autres champs de formulaire... -->

    <button type="submit" class="btn btn-primary">Enregistrer la note</button>
</form>
