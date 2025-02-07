<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="container mx-auto max-w-4xl">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Manage Events</h1>

        @foreach($events as $event)
            <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $event->title }}</h2>
                <p class="text-gray-600 mt-2">{{ $event->description }}</p>

                <!-- Actions -->
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('events.edit', ['event' => $event->id]) }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        ✏️ Edit
                    </a>

                    <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="POST" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            🗑️ Delete
                        </button>
                    </form>
                </div>

                <!-- Participants Section -->
                <h3 class="text-xl font-semibold text-gray-700 mt-6">Participants</h3>
                <div class="bg-gray-50 p-4 rounded-lg mt-2">
                    @if($event->participants->isEmpty())
                        <p class="text-gray-500">No participants yet.</p>
                    @else
                        <ul class="divide-y divide-gray-300">
                            @foreach($event->participants as $participant)
                                <li class="py-2 flex justify-between items-center">
                                    <span class="text-gray-700 font-medium">
                                        {{ $participant->name }} (Status: 
                                        <span class="font-bold {{ $participant->pivot->status == 'approved' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ ucfirst($participant->pivot->status) }}
                                        </span>)
                                    </span>
                                    <div class="flex gap-2">
                                        <a href="{{ route('events.approve', ['participantId' => $participant->id]) }}"
                                           class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                            ✅ Approve
                                        </a>
                                        <a href="{{ route('events.reject', ['participantId' => $participant->id]) }}"
                                           class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                            ❌ Reject
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this event?");
        }
    </script>

</body>
</html>
