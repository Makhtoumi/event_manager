<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Http\Request;

class CheckEventOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $model
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $param)
    {
        // The event parameter should now be resolved to an instance of the Event model
        $event = $request->route('event');
        
        // Ensure $event is an instance of Event
        if (!$event instanceof Event) {
            abort(404, 'Event not found');
        }
    
        // Check if the authenticated user owns the event
        if ($event->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to perform this action.');
        }
    
        return $next($request);
    }

}
