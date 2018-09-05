<?php
/**
 * @class        LogNewCycleListener
 * @package     App\Listeners
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
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
