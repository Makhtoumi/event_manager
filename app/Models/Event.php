<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'location', 'date', 'time', 'max_participants', 'status'
    ];

    // Function to set event status
    public function setStatus()
    {
        $currentDateTime = Carbon::now();

        $eventDateTime = Carbon::parse($this->date . ' ' . $this->time);

        if ($eventDateTime->isFuture()) {
            $this->status = 'Upcoming'; // Event is in the future
        } elseif ($eventDateTime->isPast()) {
            $this->status = 'Completed'; // Event has passed
        } else {
            $this->status = 'Ongoing'; // Event is happening now
        }

        $this->save();
    }
}
