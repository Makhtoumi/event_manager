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
    public function handle(Request $request, Closure $next, $model)
    {
        $event = $request->route($model); // Get the event from the route parameter
        if ($event->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to perform this action.');
        }
        return $next($request);
    }

}
