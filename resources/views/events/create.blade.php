<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="container mx-auto mt-10 max-w-lg bg-white shadow-lg rounded-xl p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create New Event</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-4 rounded-lg shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-300">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Event Description</label>
            <textarea name="description" id="description" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-300">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-300">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-300">
            </div>

            <div>
                <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Event Time</label>
                <input type="time" name="time" id="time" value="{{ old('time') }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-300">
            </div>
        </div>

        <div>
            <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1">Max Participants</label>
            <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants') }}" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-300">
        </div>

        <button type="submit" class="w-full py-3 bg-blue-500 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Create Event</button>
    </form>
</div>
