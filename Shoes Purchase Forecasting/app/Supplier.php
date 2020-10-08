<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Supplier extends Model
{
  protected $table = 'Supplier';
  protected $guarded = ['ID'];
  protected $fillable = ['Telepon', 'Nama', 'Alamat', 'isDelete'];

  public function StoreSupplier(Request $Request)
  {
      $unique_id = uniqid();
      $Supplier = new Supplier(array(
          'Nama' => $Request->get('NamaSupplier'),
          'Alamat' => $Request->get('AlamatSupplier'),
          'Telepon' => $Request->get('TeleponSupplier'),
          'isDelete' => (1)
      ));
      $Supplier->save();
  }

  public function UpdateSupplier(Request $Request)
  {
      $IDSupplier = $Request->get('IDSupplier');
      DB::table('Supplier')
          ->where('ID', $IDSupplier)
          ->update(['Nama' => $Request->get('NamaSupplier'),
                    'Alamat' => $Request->get('AlamatSupplier'),
                    'Telepon' => $Request->get('TeleponSupplier'),
                    'isDelete' => $Request->get('isDeleteSupplier')]);
  }
}
