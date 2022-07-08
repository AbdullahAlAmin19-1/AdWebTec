<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class placeOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $sub;
    public $user_type;
    public $username;
    public $p_name;
    public $p_quantity;
    public $p_price;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sub,$user_type,$username,$orders)
    {
        $this->sub = $sub;
        $this->user_type = $user_type;   
        $this->username = $username;    
        $this->orders = $orders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.placeOrder')
        ->with('user_type',$this->user_type)
        ->with('username',$this->username)
        ->with('orders',$this->orders)
        ->subject($this->sub);
    }
}