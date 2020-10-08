<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Nama = $Request->session()->get('Nama');
        return view('TentangKami', compact('ID', 'Nama'));
    }
}
