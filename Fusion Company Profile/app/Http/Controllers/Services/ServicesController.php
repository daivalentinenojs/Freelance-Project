<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
  public function Index() {
    return view('menu.services.index');
  }
}
