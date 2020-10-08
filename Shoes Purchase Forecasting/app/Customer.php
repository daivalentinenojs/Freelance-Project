<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Customer extends Model
{
  protected $table = 'Customer';
  protected $guarded = ['ID'];
  protected $fillable = ['Telepon', 'NamaPemilik', 'NamaToko', 'Alamat', 'isDelete', 'UserID'];

  public function StoreCustomer(Request $Request)
  {
      $unique_id = uniqid();
      $ID = $Request->session()->get('ID');
      $Customer = new Customer(array(
          'NamaPemilik' => $Request->get('NamaPemilik'),
          'NamaToko' => $Request->get('NamaToko'),
          'Alamat' => $Request->get('AlamatCustomer'),
          'Telepon' => $Request->get('TeleponCustomer'),
          'isDelete' => (1),
          'UserID' => $ID
      ));
      $Customer->save();
  }

  public function UpdateCustomer(Request $Request)
  {
      $IDCustomer = $Request->get('IDCustomer');
      DB::table('Customer')
          ->where('ID', $IDCustomer)
          ->update(['NamaPemilik' => $Request->get('NamaPemilik'),
                    'NamaToko' => $Request->get('NamaToko'),
                    'Alamat' => $Request->get('AlamatCustomer'),
                    'Telepon' => $Request->get('TeleponCustomer'),
                    'isDelete' => $Request->get('isDeleteCustomer'),
                    'UserID' => (2)]);
  }
}
