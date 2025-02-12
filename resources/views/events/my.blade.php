<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <div class="container mx-auto max-w-5xl p-6">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Manage Events</h1>

        @foreach($events as $event)
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8 border-l-4 border-blue-500 hover:shadow-xl transition duration-300">
                <h2 class="text-3xl font-semibold text-gray-900">{{ $event->title }}</h2>
                <p class="text-gray-600 mt-3 text-lg">{{ $event->description }}</p>

                <!-- Actions -->
                <div class="mt-6 flex gap-4">
                    <a href="{{ route('events.edit', ['event' => $event->id]) }}"
                       class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                        ✏️ Edit
                    </a>

                    <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="POST" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition transform hover:scale-105">
                            🗑️ Delete
                        </button>
                    </form>
                </div>

                <!-- Participants Section -->
                <h3 class="text-2xl font-semibold text-gray-700 mt-6">Participants</h3>
                <div class="bg-gray-50 p-6 rounded-lg mt-4">
                    @if($event->participants->isEmpty())
                        <p class="text-gray-500 text-center">No participants yet.</p>
                    @else
                        <ul class="divide-y divide-gray-300">
                            @foreach($event->participants as $participant)
                                <li class="py-4 flex justify-between items-center">
                                    <span class="text-lg text-gray-800">
                                        {{ $participant->name }} (Status: 
                                        <span class="font-semibold 
                                        {{ $participant->pivot->status == 'approved' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ ucfirst($participant->pivot->status) }}
                                        </span>)
                                    </span>

                                    <div class="flex gap-4">
                                        <!-- Approve Button -->
                 <!-- Approve Button -->
                 <form action="{{ route('events.participants.approve', ['event' => $event->id, 'participant' => $participant->id]) }}" method="POST" onsubmit="return confirmAction('approve');">
                         @csrf
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                            ✅ Approve
                        </button>
                    </form>

                    <!-- Reject Button -->
                    <form action="{{ route('events.participants.reject', ['event' => $event->id, 'participant' => $participant->id]) }}" method="POST" onsubmit="return confirmAction('reject');">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                            ❌ Reject
                        </button>
                    </form>

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

        function confirmAction(action) {
            return confirm(`Are you sure you want to ${action} this participant?`);
        }
    </script>

</body>
</html>
