<?php
/**
 * Class        MailNewSiteListener
 * @package     App\Listeners
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Listeners;

use App\Events\NewSiteEvent;
use App\Mail\SiteCreatedMailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
     * @todo fix smtp timeout, log for now
     */
    public function handle(NewSiteEvent $event)
    {
        if(getenv('APP_ENV') === 'production'){
            //Mail::to(Auth::user( )->email)->send(new SiteCreatedMailable($event->site));
            \Log::info('Cycle created');
        } else {
            \Log::info('Cycle created');
        }
    }
}
