<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Audit;

class AuditWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * audit
     *
     * @var mixed
     */
    public $audit;
    
    /**
     * Create a new event instance.
     *
     * @param  mixed $audit
     * @return void
     */
    public function __construct(Audit $audit)
    {
        $this->audit = $audit;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
