<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendOTP extends Mailable
{
    use Queueable, SerializesModels;
    public $sub;
    public $u_id;
    public $u_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sub,$u_id,$u_name)
    {
        $this->sub = $sub;
        $this->u_id = $u_id;   
        $this->u_name = $u_name;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.sendOTP')
        ->with('u_id',$this->u_id)
        ->with('u_name',$this->u_name)
        ->subject($this->sub);
    }
}
