<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class setPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $client_id;
    public $confirmation_code;
    public $temporary_password;
    public function __construct($client_id, $confirmation_code, $temporary_password)
    {
        $this->client_id = $client_id;
        $this->confirmation_code = $confirmation_code;
        $this->temporary_password = $temporary_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this-> from('ecommershop@gmail.com')
            ->subject('Potwierdzenie założenia konta')
            ->view('setPassword', [
                'confirmation_code' => $this->confirmation_code,
                'client_id'=> $this->client_id,
                'temporary_password' => $this->temporary_password
            ]);
    }
}
