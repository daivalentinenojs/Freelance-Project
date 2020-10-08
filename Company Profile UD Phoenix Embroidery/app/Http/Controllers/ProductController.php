<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductXCategory;
use App\Description;
use App\Category;

class ProductController extends Controller
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
        return view('Product.Index', compact('NIP', 'Name', 'Content'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $Product = new Product();
        $IDProduct = $Product->StoreProduct($Request);
        $ProductXCategory = new ProductXCategory();
        $ProductXCategory->StoreProductXCategory($Request, $IDProduct);
        return redirect('/Product')->with('status', 'Your Product Information Has Saved !');
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
        $Product = new Product();
        $IDProduct = $Product->UpdateProduct($Request);
        $ProductXCategory = new ProductXCategory();
        $ProductXCategory->UpdateProductXCategory($Request, $IDProduct);
        return redirect('/Product')->with('status', 'Your Product Information Has Changed !');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexFashion(Request $Request)
    {
        $Request->session()->get('NIP');
        $Request->session()->get('Name');

        $Description = new Description();
        $Content = $Description->GetDescription();
        $Fashion = new Product();
        $ItemCategory = $Fashion->GetFashion();
        $Category = new Category();
        $DataCategory = $Category->GetCategory(1);
        return view('Category.IndexFashion', compact('ItemCategory', 'NIP', 'Name', 'Content', 'DataCategory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexHomeDecoration(Request $Request)
    {
        $Request->session()->get('NIP');
        $Request->session()->get('Name');

        $Description = new Description();
        $Content = $Description->GetDescription();
        $HomeDecoration = new Product();
        $ItemCategory = $HomeDecoration->GetHomeDecoration();
        $Category = new Category();
        $DataCategory = $Category->GetCategory(2);
        return view('Category.IndexHomeDecoration', compact('ItemCategory', 'NIP', 'Name', 'Content', 'DataCategory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexEmbroidery(Request $Request)
    {
        $Request->session()->get('NIP');
        $Request->session()->get('Name');

        $Description = new Description();
        $Content = $Description->GetDescription();
        $Embroidery = new Product();
        $ItemCategory = $Embroidery->GetEmbroidery();
        $Category = new Category();
        $DataCategory = $Category->GetCategory(3);
        return view('Category.IndexEmbroidery', compact('ItemCategory', 'NIP', 'Name', 'Content', 'DataCategory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexSouvenir(Request $Request)
    {
        $Request->session()->get('NIP');
        $Request->session()->get('Name');

        $Description = new Description();
        $Content = $Description->GetDescription();
        $Fashion = new Product();
        $ItemCategory = $Fashion->GetSouvenir();
        $Category = new Category();
        $DataCategory = $Category->GetCategory(4);
        return view('Category.IndexSouvenir', compact('ItemCategory', 'NIP', 'Name', 'Content', 'DataCategory'));
    }
}
