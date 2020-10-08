<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\Brand;
use App\Category;
use App\SubCategory;
use App\Product;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexBrand(Request $Request, $IDS)
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
        $Data = $Brand->GetFilterBrand($IDS);
        $NamaX = $Brand->GetNamaBrand($IDS);

        $Category = new Category();
        $DataCategory = $Category->GetCategory();

        $KodeFilter = 'XB';
        $IDFilter = $IDS;
        $IDSort = 1;
        $Keyword = '';
        return view('MasterData.Filter.Index', compact('NamaX', 'Keyword', 'IDSort', 'KodeFilter', 'IDFilter', 'Content', 'DataSocialMedia', 'DataBrand', 'DataCategory', 'Data', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexCategory(Request $Request, $IDS)
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
        $Data = $Category->GetFilterCategory($IDS);
        $NamaX = $Category->GetNamaCategory($IDS);

        $KodeFilter = 'XC';
        $IDFilter = $IDS;
        $IDSort = 1;
        $Keyword = '';
        return view('MasterData.Filter.Index', compact('NamaX', 'Keyword', 'IDSort', 'KodeFilter', 'IDFilter', 'Content', 'DataSocialMedia', 'DataBrand', 'DataCategory', 'Data', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexSubCategory(Request $Request, $IDS)
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

        $SubCategory = new SubCategory();
        $Data = $SubCategory->GetFilterSubCategory($IDS);
        $NamaX = $SubCategory->GetNamaSubCategory($IDS);

        $KodeFilter = 'XS';
        $IDFilter = $IDS;
        $IDSort = 1;
        $Keyword = '';
        return view('MasterData.Filter.Index', compact('NamaX', 'Keyword', 'IDSort', 'KodeFilter', 'IDFilter', 'Content', 'DataSocialMedia', 'DataBrand', 'DataCategory', 'Data', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexSale(Request $Request)
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

        $Barang = new Product();
        $Data = $Barang->GetBarangSale();

        $KodeFilter = 'XL';
        $IDFilter = 'Sale';
        $IDSort = 1;
        $Keyword = '';
        return view('MasterData.Filter.Index', compact('IDSort', 'Keyword', 'KodeFilter', 'IDFilter', 'Content', 'DataSocialMedia', 'DataBrand', 'DataCategory', 'Data', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexSort(Request $Request, $IDSort, $KodeFilter, $IDFilter, $Keyword)
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
        if ($IDSort == '1') {
            $Data = $Product->SortNewArrival($KodeFilter, $IDFilter, $Keyword);
        } else if ($IDSort == '2') {
            $Data = $Product->SortPriceLTH($KodeFilter, $IDFilter, $Keyword);
        } else if ($IDSort == '3') {
            $Data = $Product->SortPriceHTL($KodeFilter, $IDFilter, $Keyword);
        } else if ($IDSort == '4') {
            $Data = $Product->SortNameATZ($KodeFilter, $IDFilter, $Keyword);
        } else if ($IDSort == '5') {
            $Data = $Product->SortNameZTA($KodeFilter, $IDFilter, $Keyword);
        }

        if($KodeFilter == 'XB') {
            $Brand = new Brand();
            $NamaX = $Brand->GetNamaBrand($IDFilter);
        } else if($KodeFilter == 'XC') {
            $Category = new Category();
            $NamaX = $Category->GetNamaCategory($IDFilter);
        } else if($KodeFilter == 'XS') {
            $SubCategory = new SubCategory();
            $NamaX = $SubCategory->GetNamaSubCategory($IDFilter);
        }
        
        return view('MasterData.Filter.Index', compact('NamaX', 'Keyword', 'IDSort', 'KodeFilter', 'IDFilter', 'Content', 'DataSocialMedia', 'DataBrand', 'DataCategory', 'Data', 'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function PostSort(Request $Request)
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

        $KodeFilter = $Request->get('KodeFilter');
        $IDFilter = $Request->get('IDFilter');
        $IDSort = $Request->get('IDSort');
        $Keyword = $Request->get('Keyword');
        if ($Keyword == '') {
            $Keyword = ':';
        }
        return redirect('/SortProduct/'.$IDSort.'/'.$KodeFilter.'/'.$IDFilter.'/'.$Keyword);

        // $Product = new Product();
        // if ($IDSort == '1') {
        //     $Data = $Product->SortNewArrival($KodeFilter, $IDFilter);
        // } else if ($IDSort == '2') {
        //     $Data = $Product->SortPriceLTH($KodeFilter, $IDFilter);
        // } else if ($IDSort == '3') {
        //     $Data = $Product->SortPriceHTL($KodeFilter, $IDFilter);
        // } else if ($IDSort == '4') {
        //     $Data = $Product->SortNameATZ($KodeFilter, $IDFilter);
        // } else if ($IDSort == '5') {
        //     $Data = $Product->SortNameZTA($KodeFilter, $IDFilter);
        // }
        // return view('MasterData.Filter.Index', compact('KodeFilter', 'IDFilter', 'Content', 'DataSocialMedia', 'DataBrand', 'DataCategory', 'Data', 'ID', 'Nama', 'Email', 'Role'));
    }
}
