<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Mail\UserVerificationMail;
use Auth;
use Hash;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function IndexLogin(Request $request) {
        return view('menus.login.index');
    }

    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
    protected function Login(Request $request)
    {
        $messages = [
            'email.required' => 'Email required',
            'email.email' => 'Email is not valid',
            'password.required' => 'Password required'
        ];
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],$messages);

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => '2'])) {
         return redirect('/');
       }
       return redirect(route('login'))->withInput()->withErrors(['status' => 'Your email and password didn\'t match or your email hasn\'t been verified !']);
    }

    public function Register(Request $request) {
        $message = [
          // 'name.required' => 'The email field is required.',
          // 'name.min' => 'Minimum length is 3',
        ];

        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|max:13',
            'address' => 'required|max:200',
            'password' => 'required|confirmed|min:6',
        ], $message);

        $user = new User();
        $user->nama = $request->name;
        $user->telepon = $request->telephone;
        $user->jenis_kelamin = $request->gender;
        $user->tanggal_lahir = $request->birthday;
        $user->email = $request->email;
        $user->jabatan = 2;
        $user->password =  Hash::make($request->password);
        $user->alamat = $request->address;
        $user->status = 1;
        $user->save();

        $this->SendEmail($request);

        return redirect('login')->withStatus([
          'alert'=>'alert-success',
          'status'=>'Saved !',
          'message'=>'User has been saved !'
        ]);
    }

    protected function SendEmail(Request $request)
    {
      $did = User::max('id');
      $eid = Crypt::encryptString($did);
      Mail::to($request->email)->send(new UserVerificationMail($eid));
    }

    protected function VerifyEmail(Request $request, $eid)
    {
      $did = Crypt::decryptString($eid);
      $user = User::find($did);

      if ($user->status == 1) {

        $user->status = 2;
        $user->verified_at = Carbon::now();
        $user->save();

        return redirect('login')->withStatus([
          'alert'=>'alert-success',
          'status'=>'Saved !',
          'message'=>'Your email has been verified !'
        ]);
      } else {
        return redirect(route('login'))->withInput()->withErrors(['status' => 'Your email has been verified !']);
      }
    }

    protected function Logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
