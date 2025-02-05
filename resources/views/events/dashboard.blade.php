@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5">

    <h1 class="text-2xl font-semibold">Event Dashboard</h1>

    <div class="mt-5">
        <section>
            <h2 class="text-xl font-bold">My Events</h2>
            @if ($myEvents->isEmpty())
                <p>No events created yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($myEvents as $event)
                        <div class="border p-4 rounded shadow-md">
                            <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
                            <p>{{ $event->location }}</p>
                            <p>{{ $event->date }} at {{ $event->time }}</p>
                            <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 hover:underline">View Details</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <hr class="my-6">

        <section>
            <h2 class="text-xl font-bold">Joined Events</h2>
            @if ($joinedEvents->isEmpty())
                <p>You have not joined any events yet.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($joinedEvents as $event)
                        <div class="border p-4 rounded shadow-md">
                            <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
                            <p>{{ $event->location }}</p>
                            <p>{{ $event->date }} at {{ $event->time }}</p>
                            <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 hover:underline">View Details</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <hr class="my-6">

        <section>
            <h2 class="text-xl font-bold">All Events</h2>
            @if ($allEvents->isEmpty())
                <p>No events available at the moment.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($allEvents as $event)
                        <div class="border p-4 rounded shadow-md">
                            <h3 class="text-lg font-semibold">{{ $event->title }}</h3>
                            <p>{{ $event->location }}</p>
                            <p>{{ $event->date }} at {{ $event->time }}</p>
                            <a href="{{ route('events.show', $event->id) }}" class="text-blue-500 hover:underline">View Details</a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $allEvents->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
