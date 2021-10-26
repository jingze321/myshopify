<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use Queueable,SerializesModels;
    public $user;

    public function __construct($user)
    {
        $this->user=$user;
    }

    /** 
    @return $this
    */
    public function build()
    {
        return $this->markdown('emails.auth.email_verication_mail')->with([
            'user'=>$this->user
        ]);
    }
}