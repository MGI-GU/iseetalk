<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Channel as ModelChannel;

class ChannelWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * channel
     *
     * @var mixed
     */
    public $channel;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ModelChannel $channel)
    {
        $this->channel = $channel;
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
