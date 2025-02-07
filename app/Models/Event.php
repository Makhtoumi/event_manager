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

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_participants')
                    ->withPivot('status') // Include the pivot table's 'status' column
                    ->withTimestamps(); // Include the pivot table's timestamps
    }

    public function setStatus()
    {
        $now = Carbon::now();
        if ($this->date > $now) {
            $this->status = 'upcoming';
        } elseif ($this->date <= $now && $this->date->addHours(2) >= $now) {
            $this->status = 'ongoing';
        } else {
            $this->status = 'completed';
        }
        $this->save();
    }


}
