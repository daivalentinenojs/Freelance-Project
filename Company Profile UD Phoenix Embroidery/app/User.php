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

    protected $table = 'User';
    protected $guarded = ['ID'];
    protected $fillable = ['ID', 'Name', 'Email', 'NIP', 'Password', 'IsActive'];

    public function StoreUser(Request $Request)
    {
        $unique_id = uniqid();
        $Email = $Request->get('Email');
        $Domain = $Request->get('Domain');
        $EmailLengkap = $Email.$Domain;
        $User = new User(array(
            'Name' => $Request->get('UserName'),
            'Email' => $EmailLengkap,
            'NIP' => $Request->get('NIP'),
            'Password' => $Request->get('Password'),
            'IsActive' => (1)
        ));
        $User->save();
        $ID = DB::table('User')->max('ID');
        $IDFoto = $ID.'.jpg';
        $Request->FotoUser->move(public_path('foto/user'), $IDFoto);
    }

    public function UpdateUser(Request $Request)
    {
        $IDUser = $Request->get('IDUser');
        $Email = $Request->get('Email');
        $Domain = $Request->get('Domain');
        $EmailLengkap = $Email.$Domain;
        DB::table('User')
            ->where('ID', $IDUser)
            ->update(['Name' => $Request->get('UserName'),
                'Email' => $EmailLengkap,
                'NIP' => $Request->get('NIP'),
                'Password' => $Request->get('Password'),
                'IsActive' => $Request->get('Status')]);
        $IDFoto = $IDUser.'.jpg';
        if($Request->hasFile('FotoUser')) {
            $Request->FotoUser->move(public_path('foto/user'), $IDFoto);
        }
    }
}
