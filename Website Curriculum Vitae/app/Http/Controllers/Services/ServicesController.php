<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ServicesController extends Controller
{
  public function Index() {
    return view('menu.services.index');
  }
}
