<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\Slider;
use App\Product;
use App\Brand;
use App\Category;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Dashboard(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        $Slider = new Slider();
        $SlideShow = $Slider->GetSlider();

        $Product = new Product();
        $ProductRecommendedItems = $Product->GetProductRecommendedItems();
        $ProductNew = $Product->GetProductNew();
        $ProductSale = $Product->GetProductSale();

        $Brand = new Brand();
        $DataBrand = $Brand->GetSumBrand();

        $Category = new Category();
        $DataCategory = $Category->GetCategory();

        return view('Dashboard', compact('Content', 'DataSocialMedia', 'SlideShow', 'ProductRecommendedItems',
        'ProductNew', 'ProductSale', 'DataBrand', 'DataCategory', 'ID', 'Nama', 'Email', 'Role'));
    }
}
