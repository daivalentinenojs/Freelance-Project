<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class HomeController extends Controller
{
  public function Index() {
    return view('menu.home.index');
  }
}
