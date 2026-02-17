<?php

namespace App\Listeners;

use App\Events\eventTested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class eventListened
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(eventTested $event): void
    {
        //
    }
}
