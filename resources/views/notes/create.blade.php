<form action="{{ route('notes.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    @csrf
    <!-- Sélection de l'Élément Constitutif -->
    <div class="mb-4">
        <label for="ec_id" class="block text-sm font-medium text-gray-700">Élément Constitutif</label>
        <select name="ec_id" id="ec_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @foreach($ecs as $ec)
                <option value="{{ $ec->id }}">{{ $ec->code }} - {{ $ec->nom }}</option>
            @endforeach
        </select>
        @error('ec_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Champ de la Note -->
    <div class="mb-4">
        <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
        <input type="number" name="note" id="note" min="0" max="20" step="0.25" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('note') }}">
        @error('note')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Sélection de la Session -->
    <div class="mb-4">
        <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
        <select name="session" id="session" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="normale">Session Normale</option>
            <option value="rattrapage">Rattrapage</option>
        </select>
        @error('session')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Bouton d'enregistrement -->
    <div class="mb-4">
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Enregistrer
        </button>
    </div>
</form>
