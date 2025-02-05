<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event</h1>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Title:</label>
        <input type="text" name="title" value="{{ old('title', $event->title) }}" required><br><br>

        <label>Description:</label>
        <textarea name="description">{{ old('description', $event->description) }}</textarea><br><br>

        <label>Location:</label>
        <input type="text" name="location" value="{{ old('location', $event->location) }}" required><br><br>

        <label>Date:</label>
        <input type="date" name="date" value="{{ old('date', $event->date) }}" required><br><br>

        <label>Time:</label>
        <input type="time" name="time" value="{{ old('time', $event->time) }}" required><br><br>

        <label>Max Participants:</label>
        <input type="number" name="max_participants" value="{{ old('max_participants', $event->max_participants) }}" required><br><br>

        <button type="submit">Update Event</button>
    </form>
</body>
</html>
