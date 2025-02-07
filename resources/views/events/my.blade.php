@foreach($events as $event)
    <h2>{{ $event->title }}</h2>
    <p>{{ $event->description }}</p>
    <a href="{{ route('events.edit', ['event' => $event->id]) }}" class="btn btn-primary">
        Edit
    </a>
    <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?');">
            Delete
        </button>
    </form>
    <h3>Participants:</h3>
    <ul>
        @foreach($event->participants as $participant)
        <li>
                {{ $participant->name }} (Status: {{ $participant->pivot->status }})
                <a href="{{ route('events.approve', ['participantId' => $participant->id]) }}" class="btn btn-success">
                    Approve
                </a>
                <a href="{{ route('events.reject', ['participantId' => $participant->id]) }}" class="btn btn-danger">
                    Reject
                </a>
            </li>
        @endforeach
    </ul>
@endforeach