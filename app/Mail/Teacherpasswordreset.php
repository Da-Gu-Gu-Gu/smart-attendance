<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Teacherpasswordreset extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$token)
    {
        //
        $this->name=$name;
        $this->token=$token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password Reset Mail')
                ->view('email.tpr');    //teacher password reset
    }
}
