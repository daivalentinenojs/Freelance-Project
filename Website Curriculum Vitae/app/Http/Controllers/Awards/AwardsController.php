<?php

namespace App\Http\Controllers\Awards;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AwardsController extends Controller
{
  public function Index() {
    return view('menu.awards.index');
  }
}
