<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PassStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pass;

    public function __construct($pass)
    {
        $this->pass = $pass;
    }

    public function build()
{
    return $this->subject('Bus Pass Status Update')
                ->view('emails.pass_status');
}

}
