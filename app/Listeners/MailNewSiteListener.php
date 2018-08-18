<?php

namespace App\Listeners;

use App\Events\NewSiteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNewSiteListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewSiteEvent  $event
     * @return void
     */
    public function handle(NewSiteEvent $event)
    {
        //
    }
}
