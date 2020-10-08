<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';
    protected $guarded = ['id'];
    protected $fillable = ['id', 'email', 'password'];

    public function StoreUser(Request $Request)
    {
        $unique_id = uniqid();
        $User = new User(array(
            'email' => $Request->get('Email'),
            'password' => bcrypt($Request->get('Password')),
            'IsActive' => (1)
        ));
        $User->save();
        $ID = DB::table('users')->max('id');
        return $ID;
    }

    public function UpdateUser(Request $Request)
    {
        $IDUser = $Request->get('IDUser');
        DB::table('users')
            ->where('id', $IDUser)
            ->update(['password' => bcrypt($Request->get('Password'))]);
    }

    public function UpdateProfileUser(Request $Request)
    {
        $IDUser = $Request->get('IDUser');
        DB::table('users')
            ->where('id', $IDUser)
            ->update(['password' => bcrypt($Request->get('Password'))]);
    }
}
