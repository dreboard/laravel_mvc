<?php
/**
 * @class        CycleCreatedMailable
 * @package     App\Mail
 * @since       v0.1.0
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */
namespace App\Mail;

use App\Cycle;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CycleCreatedMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The cycle instance.
     *
     * @var Cycle
     */
    public $cycle;

    /**
     * Create a new message instance.
     *
     * @param Cycle $cycle
     */
    public function __construct(Cycle $cycle)
    {
        $this->cycle = $cycle;
    }

    /**
     * Build the message.
     * {@internal Global from Address already set}}
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.cycle_create')
            ->with([
                'start_date' => $this->cycle->start_date,
                'end_date' => $this->cycle->end_date
            ]);
    }
}
