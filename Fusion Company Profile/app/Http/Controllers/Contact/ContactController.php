<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
  public function Index() {
    return view('menu.contact.index');
  }
}
