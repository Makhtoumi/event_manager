<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-2xl">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Edit Event</h1>

        <form action="{{ route('events.update', $event->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-600 font-semibold">Title:</label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                       class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Description:</label>
                <textarea name="description" rows="4"
                          class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">{{ old('description', $event->description) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Location:</label>
                <input type="text" name="location" value="{{ old('location', $event->location) }}" required
                       class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-600 font-semibold">Date:</label>
                    <input type="date" name="date" value="{{ old('date', $event->date) }}" required
                           class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block text-gray-600 font-semibold">Time:</label>
                    <input type="time" name="time" value="{{ old('time', $event->time) }}" required
                           class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Max Participants:</label>
                <input type="number" name="max_participants" value="{{ old('max_participants', $event->max_participants) }}" required
                       class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex justify-end space-x-4 mt-4">
                <a href="{{ route('events.index') }}"
                   class="px-4 py-2 text-gray-600 hover:text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Update Event
                </button>
            </div>
        </form>
    </div>

</body>
</html>
