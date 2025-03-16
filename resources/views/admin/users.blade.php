@foreach ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->statut }}</td>
        <td>
            @if ($user->statut === 'desactif')
                <form action="{{ route('profile.activate', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Activer</button>
                </form>
            @endif
        </td>
    </tr>
@endforeach

<script>
    function activerCompte(userId) {
        fetch(`/profile/${userId}/activate`, {
            method: "PUT",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            location.reload(); // Rafraîchir la page pour voir les mises à jour
        })
        .catch(error => console.error("Erreur:", error));
    }
</script>

