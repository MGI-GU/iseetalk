<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Models\Team;

class UserWasInvited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * user
     *
     * @var mixed
     */
    public $user;
    public $team;

    /**
     * Create a new event instance.
     *
     * @param  mixed $user
     * @return void
     */    
    public function __construct(User $user, Team $team)
    {
        $this->user = $user;
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
