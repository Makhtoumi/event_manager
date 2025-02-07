<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4">

    <div class="container mx-auto mt-5">
        <!-- Display Success and Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        <h1 class="text-3xl font-bold text-gray-700 mb-6">All Events</h1>

        <!-- Search & Filter -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <form action="{{ route('events.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <!-- Search Input -->
                <div class="flex-grow">
                    <input type="text" name="search" value="{{ old('search', $searchTerm) }}"
                           class="p-3 border rounded w-full focus:ring-2 focus:ring-blue-400"
                           placeholder="Search by title or location...">
                </div>

                <!-- Status Dropdown -->
                <div>
                    <select name="status" class="p-3 border rounded focus:ring-2 focus:ring-blue-400">
                        <option value="">Select Status</option>
                        <option value="upcoming" {{ $status == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ $status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <!-- Search Button -->
                <div>
                    <button type="submit" class="p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Search & Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Event List -->
        @if ($events->isEmpty())
            <p class="text-gray-600 text-center text-lg font-semibold">No events found based on your criteria.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="bg-white border rounded-lg shadow-md p-5 transition hover:shadow-xl">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $event->title }}</h3>
                        <p class="text-gray-600"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
                        <p class="text-gray-500"><i class="far fa-calendar-alt"></i> {{ $event->date }} at {{ $event->time }}</p>

                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 font-medium hover:underline">
                                View Details
                            </a>

                            <form action="{{ route('events.join', $event->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                    Join Event
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                {{ $events->links() }}
            </div>
        @endif
    </div>

</body>
</html>
