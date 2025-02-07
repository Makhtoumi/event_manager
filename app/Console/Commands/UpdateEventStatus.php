<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;


class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update event statuses based on current date';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Get all events
        $events = Event::all();

        foreach ($events as $event) {
            // Update the status of each event
            $event->setStatus();
        }

        $this->info('Event statuses have been updated successfully.');
    }
}
