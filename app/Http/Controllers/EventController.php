<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventParticipant;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EventController extends Controller
{

    public function index(Request $request)
    {
        // Get the search input
        $searchTerm = $request->get('search');
        $status = $request->get('status');
        
        // Get all events with the filters applied
        $events = Event::query();

        // Search by title or location
        if ($searchTerm) {
            $events = $events->where(function($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                      ->orWhere('location', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($status) {
            if ($status == 'upcoming') {
                $events = $events->where('date', '>', Carbon::now());
            } elseif ($status == 'ongoing') {
                $events = $events->where('date', '<=', Carbon::now())
                                 ->where('status', 'ongoing');
            } elseif ($status == 'completed') {
                $events = $events->where('status', 'completed');
            }
        }

        // Paginate the results
        $events = $events->paginate(10);

        return view('events.index', compact('events', 'searchTerm', 'status'));
    }


    public function create()
    {
        return view('events.create');
    }


    public function store(Request $request)
    {
        // Validate event data
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:events,title,NULL,id,user_id,' . Auth::id(), // Title must be unique per user
            ],
            'description' => 'nullable|string|max:1000',
            'location' => 'required|string|max:255',
            'date' => 'required|date|after:today', // Ensure the date is in the future
            'time' => 'required|date_format:H:i', // Ensure time is in the correct format
            'max_participants' => 'required|integer|min:1',
        ], [
            'title.unique' => 'You already have an event with this title.',
            'date.after' => 'The event date must be in the future.',
            'time.date_format' => 'The event time must be in the format HH:MM.',
        ]);

        // Create the event
        Event::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'time' => $request->time,
            'max_participants' => $request->max_participants,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    
   
    public function edit(Event $event)
    {
        $this->authorize('update', $event); // Check if the user can update the event
        return view('events.edit', compact('event'));
    }
    



    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event); // Check if the user can update the event
    
        $request->validate([
            'title' => 'required|string|unique:events,title,' . $event->id . ',id,user_id,' . Auth::id(),
            'description' => 'nullable|string',
            'location' => 'required|string',
            'date' => 'required|date|after:today',
            'time' => 'required',
            'max_participants' => 'required|integer|min:1',
        ]);
    
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'time' => $request->time,
            'max_participants' => $request->max_participants,
        ]);
    
        $event->setStatus();
    
        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }
    
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event); // Check if the user can delete the event
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    


    public function myEvents()
    {
        // Get the logged-in user's events with their participants and user details
        $events = Event::where('user_id', Auth::id())
                       ->with('participants') // Eager load participants (which are User models)
                       ->get();
    
        return view('events.my', compact('events'));
    }

    public function joinEvent($eventId)
    {
        $event = Event::findOrFail($eventId);
    
        // Check if the user has already requested to join
        $existingRequest = EventParticipant::where('event_id', $event->id)
                                          ->where('user_id', Auth::id())
                                          ->first();
        if ($existingRequest) {
            return redirect()->route('events.index')->with('error', 'You have already requested to join this event.');
        }
    
        // Check if the event is full
        $participantCount = $event->participants()->count();
        if ($participantCount >= $event->max_participants) {
            return redirect()->route('events.index')->with('error', 'This event is full.');
        }
    
        // Create the participation record
        EventParticipant::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);
    
        return redirect()->route('events.index')->with('success', 'Your request to join the event has been sent.');
    }

    public function approveJoinRequest($participantId)
    {
        $participant = EventParticipant::findOrFail($participantId);

    
        $event = $participant->event;
        if ($event->user_id != Auth::id()) {
            return redirect()->route('events.index')->with('error', 'You are not authorized to approve this request.');
        }

        $participant->status = 'confirmed';
        $participant->save();

        $this->sendApprovalEmail($participant);

        return redirect()->route('events.index')->with('success', 'Participant approved.');
    }

    public function rejectJoinRequest($participantId)
    {
        $participant = EventParticipant::findOrFail($participantId);

        $event = $participant->event;
        if ($event->user_id != Auth::id()) {
            return redirect()->route('events.index')->with('error', 'You are not authorized to reject this request.');
        }

        $participant->status = 'rejected';
        $participant->save();

        return redirect()->route('events.index')->with('success', 'Participant rejected.');
    }

    private function sendApprovalEmail($participant)
    {
        $user = $participant->user;

        Mail::to($user->email)->send(new \App\Mail\ParticipantApproved($participant));
    }

    public function dashboard()
    {
        $myEvents = Event::where('user_id', Auth::id())->get();
    
        $joinedEvents = Event::whereHas('participants', function ($query) {
            $query->where('user_id', Auth::id())->where('status', 'confirmed');
        })->get();
    
        $allEvents = Event::paginate(10);
    
        return view('events.dashboard', compact('myEvents', 'joinedEvents', 'allEvents'));
    }

    public function show($eventId)
    {   
        $event = Event::where('user_id', Auth::id())
        ->with('participants') // Eager load participants (which are User models)
        ->get();
        return view('events.show', compact('event' ));
    }
}


