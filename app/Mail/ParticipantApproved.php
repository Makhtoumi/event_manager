<?php

// app/Mail/ParticipantApproved.php

namespace App\Mail;

use App\Models\EventParticipant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;

    public function __construct(EventParticipant $participant)
    {
        $this->participant = $participant;
    }

    public function build()
    {
        return $this->subject('Your Participation Request has been Approved')
                    ->view('emails.participant_approved');
    }
}
