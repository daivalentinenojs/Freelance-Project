<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Description;

class CategoryController extends Controller
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
        return view('Category.Index', compact('NIP', 'Name', 'Content'));
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
        $Category = new Category();
        $Category->UpdateCategory($Request);
        return redirect('/Category')->with('status', 'Your Category Information Has Changed !');
    }
}
