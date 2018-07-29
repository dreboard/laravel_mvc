<?php

namespace App\Listeners;

use App\Events\UserLoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogLoginListener
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
     * @param  UserLoginEvent  $event
     * @return void
     */
    public function handle(UserLoginEvent $event)
    {
        \Log::info('login', ['user' => $event->user]);
    }
}
