<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Team;

class TeamWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * team
     *
     * @var mixed
     */
    public $team;

    /**
     * Create a new event instance.
     *
     * @param  mixed $team
     * @return void
     */    
    public function __construct(Team $team)
    {
        $this->team = $team;
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
