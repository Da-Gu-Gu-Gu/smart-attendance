<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Assignment;
use App\Models\Teacher;

class AssignmentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tid,$img,$title,$year,$major,$label,$name;
    
  
    public function __construct($tid,$token,$year,$major)
    {
        $this->label="assignment";
        $this->year=$year;
        $this->major=$major;
        $this->tid = $tid;
        $this->img=Teacher::where("tid",$tid)->first('img')->img;
        $this->title=Assignment::where(["tid"=>$tid,"token"=>$token])->first("title")->title;
        $this->name=Teacher::where(["tid"=>$tid])->first("name")->name;
    }

 
  
    public function broadcastOn()
    {

        if($this->year=='First Year'){
            $year=1;
        }
        if($this->year=='Second Year'){
            $year=2;
        }
        if($this->year=='Third Year'){
            $year=3;
        }
        return ['assignment'.$year.$this->major];
    }
  
    public function broadcastAs()
    {
        return 'my-event';
        // return ['my-event','data'=>$this->message];
    }
}
