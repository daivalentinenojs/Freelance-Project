<?php

namespace App\Http\Controllers\Portfolios;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PortfoliosController extends Controller
{
  public function Index() {
    return view('menu.portfolios.index');
  }
}
