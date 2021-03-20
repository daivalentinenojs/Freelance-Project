<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
  public function Index() {
    return view('menu.portfolio.index');
  }
}
