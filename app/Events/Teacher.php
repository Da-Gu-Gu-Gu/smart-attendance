<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Teacher implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message,$tid;
  
    public function __construct($message,$tid)
    {
        $this->message = $message;
        $this->tid=$tid;
    }
  
    public function broadcastOn()
    {
        return ['my-channel'.$this->tid];
    }
  
    public function broadcastAs()
    {
        return 'my-event';
        // return ['my-event','data'=>$this->message];
    }
}
