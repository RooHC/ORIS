<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailContact extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $comment)
    {
        $this->name = $name;
        $this->email = $email;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('contacto.contactMail');
    }
}
