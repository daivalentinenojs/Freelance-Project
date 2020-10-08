<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use App\Slider;
use App\Description;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Dashboard(Request $Request)
    {
        $Request->session()->get('NIP');
        $Request->session()->get('Name');

        $Description = new Description();
        $Content = $Description->GetDescription();

        $Slider = new Slider();
        $SlideShow = $Slider->GetSlider();
        return view('Dashboard', compact('NIP', 'Name', 'Content', 'SlideShow'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function AboutUs(Request $Request)
    {
        $Request->session()->get('NIP');
        $Request->session()->get('Name');

        $Description = new Description();
        $Content = $Description->GetDescription();
        return view('AboutUs', compact('Content', 'NIP', 'Name'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function AboutUsPost(Request $Request)
    {
        $Email = new Email();
        $Status = $Email->PostEmail($Request);
        return view('AboutUs', compact('Status'));
    }
}
