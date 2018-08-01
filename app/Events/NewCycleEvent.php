<?php

namespace App\Events;

use App\Cycle;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewCycleEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The cycle instance.
     *
     * @var Cycle
     */
    public $cycle;

    /**
     * Create a new event instance.
     *
     * @param Cycle $cycle
     */
    public function __construct(Cycle $cycle)
    {
        $this->cycle = $cycle;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    /*public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }*/
}
