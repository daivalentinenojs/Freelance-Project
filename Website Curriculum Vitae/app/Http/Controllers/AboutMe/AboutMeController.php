<?php

namespace App\Http\Controllers\AboutMe;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AboutMeController extends Controller
{
  public function Index() {
    return view('menu.aboutme.index');
  }
}
