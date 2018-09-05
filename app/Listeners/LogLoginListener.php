<?php
/**
 * @class        LogLoginListener
 * @package     App\Listeners
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
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
