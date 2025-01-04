<form action="{{ route('notes.update', $note->id) }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    @csrf
    @method('PUT') 
    <div class="mb-4">
        <label for="ec_id" class="block text-sm font-medium text-gray-700">Élément Constitutif</label>
        <select name="ec_id" id="ec_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @foreach($ecs as $ec)
                <option value="{{ $ec->id }}" {{ $ec->id == $note->ec_id ? 'selected' : '' }}>
                    {{ $ec->code }} - {{ $ec->nom }}
                </option>
            @endforeach
        </select>
        @error('ec_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Champ de la Note -->4o
    <div class="mb-4">
        <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
        <input type="number" name="note" id="note" min="0" max="20" step="0.25" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('note', $note->note) }}">
        @error('note')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Sélection de la Session -->
    <div class="mb-4">
        <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
        <select name="session" id="session" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="normale" {{ $note->session == 'normale' ? 'selected' : '' }}>Session Normale</option>
            <option value="rattrapage" {{ $note->session == 'rattrapage' ? 'selected' : '' }}>Rattrapage</option>
        </select>
        @error('session')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Bouton de mise à jour -->
    <div class="mb-4">
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Mettre à jour
        </button>
    </div>
</form>
