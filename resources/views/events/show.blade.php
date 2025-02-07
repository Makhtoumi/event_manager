<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="container mx-auto max-w-3xl bg-white p-6 rounded-lg shadow-lg">
        
        <!-- Event Details -->
        <h2 class="text-3xl font-bold text-gray-800">{{ $event->title }}</h2>
        <p class="text-gray-600 mt-2">{{ $event->description }}</p>

        <div class="mt-4 space-y-2">
            <p class="text-gray-700"><strong>📍 Location:</strong> {{ $event->location }}</p>
            <p class="text-gray-700"><strong>👥 Max Participants:</strong> {{ $event->max_participants }}</p>
            <p class="text-gray-700">
                <strong>📅 Status:</strong> 
                <span class="px-2 py-1 rounded-lg text-white 
                    {{ $event->status == 'upcoming' ? 'bg-blue-500' : ($event->status == 'ongoing' ? 'bg-yellow-500' : 'bg-gray-500') }}">
                    {{ ucfirst($event->status) }}
                </span>
            </p>
        </div>

        <!-- Participants Section -->
        <h2 class="text-2xl font-semibold text-gray-800 mt-6">Participants</h2>
        <div class="bg-gray-50 p-4 rounded-lg mt-3">
            @if($event->participants->isEmpty())
                <p class="text-gray-500">No participants yet.</p>
            @else
                <ul class="divide-y divide-gray-300">
                    @foreach($event->participants as $participant)
                        <li class="py-2 flex justify-between items-center">
                            <span class="text-gray-700 font-medium">
                                {{ $participant->name }} 
                                (<span class="font-bold {{ $participant->pivot->status == 'approved' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ ucfirst($participant->pivot->status) }}
                                </span>)
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>

</body>
</html>
