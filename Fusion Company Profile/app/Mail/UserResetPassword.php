<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $eid;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eid, $email)
    {
        $this->eid = $eid;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $eid = $this->eid;
      $email = $this->email;

      return $this->from(env('MAIL_USERNAME'), '3Vite Official')
                  ->subject('Reset Your Password')
                  ->view('emails.user-reset-password', compact('eid', 'email'));
    }
}
