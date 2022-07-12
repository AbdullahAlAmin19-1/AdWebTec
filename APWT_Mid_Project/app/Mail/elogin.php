<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class elogin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sub,$user_type,$email,$id)
    {
        $this->sub = $sub;
        $this->user_type = $user_type;   
        $this->email = $email;    
        $this->id = $id;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.elogin')
        ->with('user_type',$this->user_type)
        ->with('email',$this->email)
        ->with('id',$this->id)
        ->subject($this->sub);
    }
}
