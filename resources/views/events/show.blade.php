@foreach($event as $e)
    <h2>{{ $e->title }}</h2>
    <p>{{ $e->description }}</p>
    <p>{{ $e->location }}</p>
    <p>{{ $e->max_participants }}</p>
    <p>{{ $e->status }}</p>



    <h2>Participants:</h2>
    <ul>
        @foreach($e->participants as $participant)
            <li>
                {{ $participant->name }} (Status: {{ $participant->pivot->status }})
            </li>
        @endforeach
    </ul>
@endforeach