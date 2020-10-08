<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\Product;
use App\Bank;
use App\SalesOrder;
use App\SalesOrderXProduct;
use DB;

class ShopingCartController extends Controller
{
    public function AddCart(Request $Request, $ID)
    {
        if (!empty($Request->session()->get('Cart'))) {
            $ArrayBarang = $Request->session()->get('Cart');
            $JumlahBarang = $Request->session()->get('JumlahBarang');
        } else {
            $ArrayBarang = array();
            $JumlahBarang = 0;
        }

        if (!in_array($ID, $ArrayBarang)) {
            $JumlahBarang++;
            array_push($ArrayBarang, $ID);
            $Request->session()->put('Cart', $ArrayBarang);
            $Request->session()->put('JumlahBarang', $JumlahBarang);
        }
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
        $Cart = $Request->session()->get('Cart');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        $Bank = new Bank();
        $DataBank = $Bank->GetBank();

        $ShopingCart = new Product();
        $DataShopingCart = $ShopingCart->GetProductShopingCart($Cart);

        return view('ShoppingCart.Create', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role', 'Cart', 'DataBank', 'DataShopingCart'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexCheckOut(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');
        $Cart = $Request->session()->get('Cart');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        $Bank = new Bank();
        $DataBank = $Bank->GetBank();

        $ID = DB::table('NotaJual')->max('ID');
        $NotaJual = new SalesOrder();
        $DataNotaJual = $NotaJual->GetNotaJualSatu($ID);
        return view('ShoppingCart.Index', compact('Content', 'DataSocialMedia', 'ID', 'Nama', 'Email', 'Role', 'DataNotaJual', 'DataBank'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function Store(Request $Request)
    {
        $NotaJual = new SalesOrder();
        $IDNotaJual = $NotaJual->StoreNotaJual($Request);

        $NotaJualXProduct = new SalesOrderXProduct();
        $NotaJualXProduct->StoreNotaJualXProduct($Request, $IDNotaJual);

        $Request->session()->forget('Cart');
        $Request->session()->forget('JumlahBarang');
        return redirect('/CheckOutInformation');
    }
}
