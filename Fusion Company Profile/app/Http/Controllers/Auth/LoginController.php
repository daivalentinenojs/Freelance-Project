<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserVerificationMail;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

use Redirect;
use Validator;

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

    public function IndexLogin(Request $request)
    {
        return view('menus.login.index-login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    public function StoreLogin(Request $request)
    {
        $message = [
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], $message);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }

        $email = $request->input('email');
        $password = $request->input('password');

//        $response = Http::post('http://101.50.0.99:30378/v1/login', [
//            'username' => $email,
//            'password' => $password,
//        ]);

//        if($response['success']) {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user = DB::table('user')->select('status')->where('email', $email)->first();
                if ($user->status == '1') {
                    $messages = "Please verify your account through your email !";
                    return Redirect::to('login')
                        ->withErrors($messages);
                } else {
                    return redirect('/');
                }
            }
//        }

        $messages = "Your email and password didn't match !";
        return Redirect::to('login')
            ->withErrors($messages)
            ->withInput();
    }

    public function IndexRegister(Request $request)
    {
        return view('menus.login.index-register');
    }

    public function StoreRegister(Request $request)
    {
        $message = [
            'email.unique' => 'Your email has been registered',
            'password.confirmed' => 'Your password and confirmation password must be match',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8',
        ], $message);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->StoreUser($request);
        $user->SendEmail($request);

        return redirect('login')->withStatus([
            'alert' => 'alert-success',
            'status' => 'Saved !',
            'message' => 'Your account has been registered, please verify it first'
        ]);
    }

    public function IndexProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return view('menus.profile.index', compact('user'));
    }

    public function UpdateProfile(Request $request)
    {
        $message = [];

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required|min:12',
            'telephone' => 'required|min:10',
        ], $message);

        if ($validator->fails()) {
            return redirect('profile')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->UpdateUser($request);

        return redirect('profile')->withStatus([
            'alert' => 'alert-success',
            'status' => 'Success !',
            'message' => 'Your profile has been updated !'
        ]);
    }

    public function IndexAccount(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return view('menus.account.index', compact('user'));
    }

    public function UpdateAccount(Request $request)
    {
        $message = [
            'password.confirmed' => 'Your password and confirmation password must be match',
        ];

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
        ], $message);

        if ($validator->fails()) {
            return redirect('account')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->UpdateAccount($request);

        return redirect('account')->withStatus([
            'alert' => 'alert-success',
            'status' => 'Success !',
            'message' => 'Your account has been updated !'
        ]);
    }

    public function IndexRegisterEO(Request $request)
    {
        return view('menus.login.index-register-eo');
    }

    public function StoreRegisterEO(Request $request)
    {
        $message = [
            'email.unique' => 'Your email has been registered',
            'password.confirmed' => 'Your password and confirmation password must be match',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:8',
        ], $message);

        if ($validator->fails()) {
            return redirect('register-eo')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->StoreEO($request);
        $user->SendEmail($request);

        return redirect('login')->withStatus([
            'alert' => 'alert-success',
            'status' => 'Saved !',
            'message' => 'Your account has been registered, please verify it first'
        ]);
    }

    protected function StoreVerification(Request $request, $eid) {
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

    public function IndexResetPassword(Request $request)
    {
        return view('menus.login.index-reset');
    }

    protected function RequestResetPassword(Request $request) {
        $email = $request->email;

        $message = [];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ], $message);

        if ($validator->fails()) {
            return redirect('register-eo')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->SendEmailReset($request);

        return view('menus.login.index-reset-instruction', compact('email'));
    }

    public function IndexNewPassword(Request $request)
    {
        return view('menus.login.index-new-password');
    }

    public function RequestNewPassword(Request $request)
    {
        $message = [
            'password.confirmed' => 'Your password and confirmation password must be match',
        ];

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
        ], $message);

        if ($validator->fails()) {
            return redirect('/reset-password/'.$request->id)
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->UpdateAccount($request);

        return redirect('login')->withStatus([
            'alert' => 'alert-success',
            'status' => 'Success !',
            'message' => 'Your password has been reset !'
        ]);
    }

    public function StoreLogout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
