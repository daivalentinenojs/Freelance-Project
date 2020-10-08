<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyDescription;
use App\SocialMedia;
use App\SalesOrder;
use App\Product;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function AjaxSalesOrderCustomer(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $AjaxSalesOrder = new SalesOrder();
        $DataAjaxSalesOrder = $AjaxSalesOrder->GetAjaxSalesOrderCustomer($ID);
        return $DataAjaxSalesOrder;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function AjaxSalesOrderEmployee(Request $Request)
    {
        $AjaxSalesOrder = new SalesOrder();
        $DataAjaxSalesOrder = $AjaxSalesOrder->GetAjaxSalesOrderEmployee();
        return $DataAjaxSalesOrder;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexSalesOrderCustomer(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        return view('MasterData.SalesOrder.IndexCustomer', compact('Content', 'DataSocialMedia',
        'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function IndexSalesOrderEmployee(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $Email = $Request->session()->get('Email');
        $Nama = $Request->session()->get('Nama');
        $Role = $Request->session()->get('Role');

        $CompanyDescription = new CompanyDescription();
        $Content = $CompanyDescription->GetCompanyDescription();

        $SocialMedia = new SocialMedia();
        $DataSocialMedia = $SocialMedia->GetSocialMedia();

        return view('MasterData.SalesOrder.IndexEmployee', compact('Content', 'DataSocialMedia',
        'ID', 'Nama', 'Email', 'Role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function UpdateSalesOrderCustomer(Request $Request)
    {
        $SalesOrder = new SalesOrder();
        $SalesOrder->UpdateSalesOrderCustomer($Request);
        return redirect('/TransactionCustomer')->with('status', 'Your sales order status has been changed!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function UpdateSalesOrderEmployee(Request $Request)
    {
        $ID = $Request->session()->get('ID');
        $SalesOrder = new SalesOrder();
        $SalesOrder->UpdateSalesOrderEmployee($Request, $ID);

        $IDStatusNotaJualBaru = $Request->get('IDStatusNotaJualBaru');
        if ($IDStatusNotaJualBaru == 1) {
            $Product = new Product();
            $Product->UpdateMinusStock($Request);
        }
        return redirect('/TransactionEmployee')->with('status', 'Your sales order status has been changed!');
    }
}
