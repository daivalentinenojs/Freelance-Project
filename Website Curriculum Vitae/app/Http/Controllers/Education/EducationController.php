<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EducationController extends Controller
{
  public function Index() {
    return view('menu.education.index');
  }
}
