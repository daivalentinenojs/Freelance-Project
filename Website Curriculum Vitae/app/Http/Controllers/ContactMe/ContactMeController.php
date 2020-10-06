<?php

namespace App\Http\Controllers\ContactMe;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Mail\UserVerificationMail;
use Illuminate\Http\Request;
use Mail;

class ContactMeController extends Controller
{
  public function Index() {
    return view('menu.contactme.index');
  }

  public function Send(Request $request) {   
    Mail::to('daivalentinenojs@gmail.com')->send(new UserVerificationMail($request));    

    return redirect('contact-me')->withStatus([
      'alert'=>'alert-success',
      'status'=>'Thank you for contacting me.',
      'message'=>'Your message has been sent !'
    ]);
  }
}
