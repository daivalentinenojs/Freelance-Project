<?php

namespace App\Http\Controllers\ContactUs;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ContactUsController extends Controller
{
  public function Index() {
    return view('menus.contactus.index');
  }
}
