<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\Product;
use App\SubCategory;
use App\Brand;
use App\ProductStatus;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Ajax()
    {
        $AjaxProduct = new Product();
        $DataAjaxProduct = $AjaxProduct->GetAjaxProduct();
        return $DataAjaxProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function AjaxInventory()
    {
        $AjaxProduct = new Product();
        $DataAjaxProduct = $AjaxProduct->GetAjaxInventoryProduct();
        return $DataAjaxProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function Index(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        $SubCategory = new SubCategory();
        $DataSubCategory = $SubCategory->GetSubCategory();

        $Brand = new Brand();
        $DataBrand = $Brand->GetBrand();

        $ProductStatus= new ProductStatus();
        $DataProductStatus = $ProductStatus->GetProductStatus();

        return view('MasterData.Product.Index', compact('Content', 'DataSocialMedia', 'DataSubCategory', 'DataBrand',
        'DataProductStatus', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexDetail(Request $Request, $IDS)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        $SubCategory = new SubCategory();
        $DataSubCategory = $SubCategory->GetSubCategory();

        $Category = new Category();
        $DataCategory = $Category->GetCategory();

        $Brand = new Brand();
        $DataBrand = $Brand->GetSumBrand();

        $ProductStatus= new ProductStatus();
        $DataProductStatus = $ProductStatus->GetProductStatus();

        $Barang = new Product();
        $DataProduct = $Barang->GetProductDetail($IDS);

        return view('MasterData.Product.Detail', compact('Content', 'DataSocialMedia', 'DataBrand', 'DataProduct', 'DataSubCategory', 'DataProductStatus',
        'ID', 'Nama', 'Email', 'Role', 'DataCategory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexSearch(Request $Request, $Keyword)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        $Brand = new Brand();
        $DataBrand = $Brand->GetSumBrand();

        $Category = new Category();
        $DataCategory = $Category->GetCategory();

        $Product = new Product();
        $Data = $Product->GetProductSearch($Keyword);

        $KodeFilter = ':';
        $IDFilter = 0;
        $IDSort = 1;

        return view('MasterData.Filter.Index', compact('IDSort', 'Keyword', 'KodeFilter', 'IDFilter', 'Content', 'DataSocialMedia', 'DataBrand', 'DataCategory', 'Data', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PostSearch(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        $Brand = new Brand();
        $DataBrand = $Brand->GetSumBrand();

        $Category = new Category();
        $DataCategory = $Category->GetCategory();

        $Keyword = $Request->get('ScriptBox');
        $Product = new Product();
        $Data = $Product->GetProductSearch($Keyword);

        $KodeFilter = $Request->get('KodeFilter');
        $IDFilter = 0;
        $IDSort = 1;

        // return view('MasterData.Filter.Index', compact('IDSort', 'KodeFilter', 'IDFilter', 'Content', 'DataSocialMedia', 'DataBrand', 'DataCategory', 'Data', 'ID', 'Nama', 'Email', 'Role'));

        return redirect('/SearchProduct/'.$Keyword);

        // return view('MasterData.Filter.Index', compact('KodeFilter', 'IDFilter', 'Content', 'DataSocialMedia', 'DataBrand', 'DataCategory', 'Data', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexInventory(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        return view('MasterData.Inventory.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role'));
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
        $Product->StoreProduct($Request);
        return redirect('/Product')->with('status', 'Your Product Data has been saved!');
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
        $Product->UpdateProduct($Request);
        return redirect('/Product')->with('status', 'Your Product Data has been changed!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function UpdateInventory(Request $Request)
    {
        $Product = new Product();
        $Product->UpdateProductInventory($Request);
        return redirect('/Inventory')->with('status', 'Your Inventory Data has been changed!');
    }
}
