<?php
/**
 * @class        MailNewCycleListener
 * @package     App\Listeners
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
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
        if(getenv('APP_ENV') === 'production'){
            Mail::to(Auth::user( )->email)->send(new CycleCreatedMailable($event->cycle));

        } else {
            \Log::info('Cycle created');
        }

    }
}
