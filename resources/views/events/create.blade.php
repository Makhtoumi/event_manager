@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-semibold mb-4">Create New Event</h1>

    
    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Event Description</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Event Date</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="time" class="block text-sm font-medium text-gray-700">Event Time</label>
            <input type="time" name="time" id="time" value="{{ old('time') }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label for="max_participants" class="block text-sm font-medium text-gray-700">Max Participants</label>
            <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants') }}" class="w-full p-2 border rounded">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Create Event</button>
    </form>
</div>
@endsection
