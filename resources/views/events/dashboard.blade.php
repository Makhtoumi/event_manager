<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen p-6">

    <div class="container mx-auto max-w-6xl bg-white shadow-lg rounded-xl p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">🎉 Event Dashboard</h1>

        <!-- Create New Event Button -->
        <div class="text-right mb-4">
            <a href="{{ route('events.create') }}" 
               class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                + Create New Event
            </a>
        </div>

        <div class="mt-5 space-y-10">

            <!-- My Events Section -->
            <section>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">📌 My Events</h2>
                @if ($myEvents->isEmpty())
                    <p class="text-gray-600">No events created yet.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($myEvents as $event)
                            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <h3 class="text-lg font-semibold text-gray-700">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $event->location }}</p>
                                <p class="text-sm text-gray-500">{{ $event->date }} at {{ $event->time }}</p>
                                <a href="{{ route('events.show', $event->id) }}" class="mt-2 inline-block text-blue-500 hover:underline">View Details</a>
                            </div>
                        @endforeach
                    </div>
                @endif
                <a href="{{ route('events.my') }}" class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105">
    Manage My Events
</a>

            </section>

            <hr class="border-gray-300">

            <!-- Joined Events Section -->
            <section>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">✅ Joined Events</h2>
                @if ($joinedEvents->isEmpty())
                    <p class="text-gray-600">You have not joined any events yet.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($joinedEvents as $event)
                            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <h3 class="text-lg font-semibold text-gray-700">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $event->location }}</p>
                                <p class="text-sm text-gray-500">{{ $event->date }} at {{ $event->time }}</p>
                                <a href="{{ route('events.show', $event->id) }}" class="mt-2 inline-block text-blue-500 hover:underline">View Details</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <hr class="border-gray-300">

            <!-- All Events Section -->
            <section>
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">🌍 All Events</h2>
                @if ($allEvents->isEmpty())
                    <p class="text-gray-600">No events available at the moment.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($allEvents as $event)
                            <div class="bg-white border border-gray-200 p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <h3 class="text-lg font-semibold text-gray-700">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $event->location }}</p>
                                <p class="text-sm text-gray-500">{{ $event->date }} at {{ $event->time }}</p>
                                <a href="{{ route('events.show', $event->id) }}" class="mt-2 inline-block text-blue-500 hover:underline">View Details</a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex justify-center">
                        {{ $allEvents->links('pagination::tailwind') }}
                    </div>
                @endif
            </section>
        </div>
    </div>

</body>
</html>
