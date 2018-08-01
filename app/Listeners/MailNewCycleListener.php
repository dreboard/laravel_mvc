<?php

namespace App\Listeners;

use App\Events\NewCycleEvent;
use App\Mail\CycleCreatedMailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class MailNewCycleListener
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
     * @param  NewCycleEvent  $event
     * @return void
     */
    public function handle(NewCycleEvent $event)
    {
        Mail::to(Auth::user( )->email)->send(new CycleCreatedMailable($event->cycle));
    }
}
