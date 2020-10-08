<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\NotaBeli;
use DB;

class NotaPesanController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return Response
      */
    public function Index(Request $Request)
    {
        $ID = $Request->session()->get('ID'); // 3
        $Name = $Request->session()->get('Name'); // 4
        $IDJabatan = $Request->session()->get('IDJabatan');
        $Jabatan = $Request->session()->get('Jabatan');
        return view('NotaPesan.DataNotaPesan', compact('ID', 'Jabatan', 'IDJabatan', 'Name'));
    }
}
