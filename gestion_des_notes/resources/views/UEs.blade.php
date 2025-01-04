<table class="table table-bordered">
    <thead>
        <tr>
            <th>Code UE</th>
            <th>Nom</th>
            <th>ECTS</th>
            <th>Semestre</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ues as $ue)
            <tr>
                <td>{{ $ue->code }}</td>
                <td>{{ $ue->nom }}</td>
                <td>{{ $ue->credits }}</td>
                <td>S{{ $ue->semestre }}</td>
                <td>
                    <a href="{{ route('ues.edit', $ue->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                    <form action="{{ route('ues.destroy', $ue->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
