<?php

namespace App\Http\Controllers\WorkExperience;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class WorkExperienceController extends Controller
{
  public function Index() {
    return view('menu.workexperience.index');
  }
}
