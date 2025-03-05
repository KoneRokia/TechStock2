<x-app-layout>
<div class="container">
    <h3>Notifications</h3>

    @if($notifications->count())
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item">
                    <strong>{{ $notification->data['title'] }}</strong>
                    <p>{{ $notification->data['message'] }}</p>
                    <small>Envoyé à {{ $notification->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucune notification.</p>
    @endif

                
</div>
</x-app-layout>
