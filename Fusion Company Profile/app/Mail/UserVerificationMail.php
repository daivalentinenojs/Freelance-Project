<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $eid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($eid)
    {
        $this->eid = $eid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $eid = $this->eid;

      return $this->from('noreply@3vite.com')
                  ->subject('Email Verification')
                  ->view('emails.user-verification', compact('eid'));
    }
}
