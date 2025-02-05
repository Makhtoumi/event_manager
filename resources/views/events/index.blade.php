

<div class="container mx-auto mt-5">

    <h1 class="text-2xl font-semibold mb-4">All Events</h1>

    <div class="flex mb-4">
        <form action="{{ route('events.index') }}" method="GET" class="flex w-full gap-4">
            <div class="flex-grow">
                <input type="text" name="search" value="{{ old('search', $searchTerm) }}" class="p-2 border rounded w-full" placeholder="Search by title or location...">
            </div>

            <div>
                <select name="status" class="p-2 border rounded">
                    <option value="">Select Status</option>
                    <option value="upcoming" {{ $status == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="ongoing" {{ $status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div>
                <button type="submit" class="p-2 bg-blue-500 text-white rounded">Search & Filter</button>
            </div>
        </form>
    </div>

    @if ($events->isEmpty())
        <p>No events found based on your criteria.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($events as $event)
                <div class="border p-4 rounded shadow-md">
                    <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
                    <p>{{ $event->location }}</p>
                    <p>{{ $event->date }} at {{ $event->time }}</p>                
                    <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 hover:underline">View Details</a>
                    <form action="{{ route('events.join', $event->id) }}" method="POST">  
                    <a href="{{ route('events.join', ['id' => $event->id]) }}">Join Event</a>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $events->links() }}
        </div>
    @endif
</div>
