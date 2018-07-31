<?php

namespace App\Listeners;

use App\Events\NewCycleEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class LogNewCycleListener
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
        \Log::channel('cycle')->info('A new cycle was created on'.date('Y-m-d h:i:s').' by '.Auth::user( )->email);
    }
}
