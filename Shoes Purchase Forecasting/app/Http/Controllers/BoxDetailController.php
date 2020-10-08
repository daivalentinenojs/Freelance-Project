<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MerekCatatBoxDetail;
use App\BoxDetail;
use DB;

class BoxDetailController extends Controller
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
        return view('MasterData/DataBoxDetail', compact('ID', 'Jabatan', 'IDJabatan', 'Name'));
    }
}
