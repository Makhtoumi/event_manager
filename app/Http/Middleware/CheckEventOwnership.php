<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class CheckEventOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $eventId
     * @return mixed
     */
    public function handle($request, Closure $next, $eventId)
    {
        $event = Event::findOrFail($eventId);

        // Check if the logged-in user is the event owner
        if ($event->user_id !== Auth::id()) {
            return redirect()->route('events.index')->with('error', 'You are not authorized to manage this event.');
        }

        return $next($request);
    }
}
