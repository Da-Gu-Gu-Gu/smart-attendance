<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $verify_number;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verify_number)
    {
        //
        $this->verify_number=$verify_number;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Verification Code Mail')
        ->view('email.email');
    }
}
