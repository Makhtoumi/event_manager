@extends('layouts.app')
@section('content')
<div class="container mx-auto mt-5">
    <div class="border p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold">{{ $event->title }}</h1>
        <p><strong>Location:</strong> {{ $event->location }}</p>
        <p><strong>Date:</strong> {{ $event->date }} at {{ $event->time }}</p>
        <p><strong>Description:</strong> {{ $event->description }}</p>
        <p><strong>Max Participants:</strong> {{ $event->max_participants }}</p>

        <hr class="my-4">

        <h3 class="text-xl font-semibold">Join Requests:</h3>
        @foreach ($event->participants as $participant)
            <div>
                <p>{{ $participant->user->name }} - Status: {{ ucfirst($participant->status) }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
