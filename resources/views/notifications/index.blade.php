<x-app-layout>
    <div >
        <h3 class="text-2xl font-bold mb-6 text-gray-800 f:text-gray-200">Notifications</h3>

        @if($notifications->count())
            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="bg-white f:bg-gray-800 shadow rounded-lg p-4 hover:bg-gray-50 f:hover:bg-gray-700 transition duration-200 flex justify-between items-start">
                        <div>
                            <div class="flex items-center space-x-2">
                                <strong class="text-lg text-gray-900 f:text-gray-100">{{ $notification->data['title'] }}</strong>
                                @if(!$notification->read_at)
                                    <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">Non lu</span>
                                @endif
                            </div>
                            <p class="mt-2 text-gray-700 f:text-gray-300">{{ $notification->data['message'] }}</p>
                            <small class="text-gray-500 f:text-gray-400">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="ml-4">
                            @if(!$notification->read_at)
                                <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-3 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition">Marquer comme lu</button>
                                </form>
                            @else
                                <span class="text-green-500 font-medium text-sm">Lu</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-10">
                <p class="text-gray-500 f:text-gray-400 text-lg">Aucune notification pour le moment.</p>
            </div>
        @endif
    </div>
</x-app-layout>
