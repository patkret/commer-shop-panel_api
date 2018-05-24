<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $message;
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build( )
    {
//        dd($this->message);
//        print_r($this->message);
//        print_r(gettype($this->message));
        return $this-> from('ecommershop@gmail.com')
            ->view('register', [
                'test' => $this->message
            ]);
    }
}
