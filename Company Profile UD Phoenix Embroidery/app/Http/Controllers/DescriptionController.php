<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Description;

class DescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Index(Request $Request)
    {
        $Request->session()->get('NIP');
        $Request->session()->get('Name');

        $Description = new Description();
        $Content = $Description->GetDescription();
        return view('Description.Index', compact('Content', 'NIP', 'Name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function Update(Request $Request)
    {
        $Description = new Description();
        $Description->UpdateDescription($Request);
        return redirect('/CompanyDescription')->with('status', 'Your Company Description Has Changed !');
    }
}
