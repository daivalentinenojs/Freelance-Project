<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Helper extends Model
{
    public static function isNotNullExist($var)
    {
        if(!isset($var))
            return false;
        foreach($var as $v)
        {
            if(isset($v))
                return true;
        }
    }
}
