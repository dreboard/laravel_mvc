<?php

namespace App\Listeners;

use App\Events\NewSiteEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class LogNewSiteListner
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
        \Log::channel('cycle')->info('A new site was created on'.date('Y-m-d h:i:s').' by '.Auth::user( )->email);
    }
}
