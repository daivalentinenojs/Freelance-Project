<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserVerificationMail;
use App\Mail\UserResetPassword;
use Carbon\Carbon;
use DateTime;
use DB;
use Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'user';
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = ['id', 'email', 'password', 'name', 'gender', 'address', 'telephone', 'birthday', 'status', 'api_token', 'role_id', 'verified_at'];

    public function StoreUser(Request $request)
    {
        $unique_id = uniqid();
        $user = new User(array(
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role_id' => (3),
            'status' => (1),
        ));
        $user->save();

        return $user;
    }

    public function StoreEO(Request $request)
    {
        $unique_id = uniqid();
        $user = new \App\Models\User(array(
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role_id' => (2),
            'status' => (1),
        ));
        $user->save();
    }

    public function SendEmail(Request $request)
    {
        $did = User::max('id');
        $eid = Crypt::encryptString($did);
        Mail::to($request->email)->send(new UserVerificationMail($eid));
    }

    public function SendEmailReset(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        $eid = Crypt::encryptString($user->id);
        Mail::to($request->email)->send(new UserResetPassword($eid, $email));
    }

    public function ValidateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function UpdateUser(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->telephone = $request->telephone;
        $user->birthday = $request->birthday;
        $user->updated_at = Carbon::now();
        $user->save();
    }

    public function UpdateAccount(Request $request)
    {
        $did = Crypt::decryptString($request->id);
        $user = User::find($did);
        $user->password = bcrypt($request->password);
        $user->updated_at = Carbon::now();
        $user->save();
    }
}
