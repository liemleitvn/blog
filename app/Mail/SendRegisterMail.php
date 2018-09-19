<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
        \Log::info('OK?');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.registerEmail', ['name' => $this->name, 'email'=>$this->email]);
    }
}
