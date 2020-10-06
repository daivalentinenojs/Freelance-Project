<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class UserVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $req;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->req = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->from($request->email)
            ->subject($request->subject)
            ->view('menu.contactme.mail')
                ->with([
                'request' => $this->req
                ]);;
    }
}
