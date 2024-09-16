<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Audio;

class AudioWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * audio
     *
     * @var mixed
     */
    public $audio;

    /**
     * Create a new event instance.
     *
     * @param  mixed $audio
     * @return void
     */
    public function __construct(Audio $audio)
    {
        $this->audio = $audio;
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
