<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;

class TeacherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tid,$img,$name;
  
    public function __construct($tid,$sender)
    {
    
        $this->img=Student::where("rollno",$sender)->first('img')->img;
        $this->name=Student::where("rollno",$sender)->first('name')->name;
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
