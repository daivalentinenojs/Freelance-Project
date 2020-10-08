<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class ProductXCategory extends Model
{
    protected $table = 'ProductXCategory';
    protected $guarded = ['IDProductXCategory'];
    protected $fillable = ['IDProductXCategory', 'IDProduct', 'IDCategory', 'IsActive'];

    public function StoreProductXCategory(Request $Request, $IDProduct)
    {
        $unique_id = uniqid();
        $ListCategory = $Request->get('CheckBoxCategory');
        for ($i=0; $i < count($Request->get('CheckBoxCategory')); $i++) {
            $IDCategory = $ListCategory[$i];
            $ProductXCategory = new ProductXCategory(array(
                'IDProduct' => $IDProduct,
                'IDCategory' => $IDCategory,
                'IsActive' => (1)
            ));
            $ProductXCategory->save();
        }
    }

    public function UpdateProductXCategory(Request $Request, $IDProduct)
    {
        $ListCategory = $Request->get('CheckBoxCategory');
        for ($i=0; $i < count($Request->get('CheckBoxCategory')); $i++) {
            $IDCategory = $ListCategory[$i];
            $ProductXCategory = new ProductXCategory(array(
                'IDProduct' => $IDProduct,
                'IDCategory' => $IDCategory,
                'IsActive' => $Request->get('StatusProduct')
            ));
            $ProductXCategory->save();
        }
    }
}
