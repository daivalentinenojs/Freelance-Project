<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class EmailController extends Controller
{
  public function Index() {
    return view('menu.contactme.index');
  }

  // function send(Request $request) {
  //   $this->validate($request, [
  //     'name'     =>  'required',
  //     'email'  =>  'required|email',
  //     'message' =>  'required'
  //   ]);

  //   $data = array(
  //     'name'      =>  $request->name,
  //     'message'   =>   $request->message
  //   );
    
  //   print($request->name)
  //   print($request->message)
  //   Mail::to('daivalentinenojs@gmail.com')->send(new SendMail($data));
  //   return back()->with('success', 'Thanks for contacting me!');

  //   }
}
