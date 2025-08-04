<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('authentication.login');
    }

    public function authenticate(Request $request)
    {

        $this->validate(
            $request,
            [
                'username'          => 'required',
                'password'          => 'required|min:6',
                //'user_code'         => 'required'
            ],
            [
                'username.required'     => 'Please provide your username for Login.',
                'password.required'     => 'Password required for login',
                'password.min'          => 'Password length should be more than 6 character or digit or mix',
                //'user_code.required'    => 'Security Code Is Required For Your Information Safety, Thank You.'
            ]
        );

        $username = strtoupper($request->username);
        $password = $request->password;
        //$user_code = $request->user_code;
        //dd($username."--".$password);
        //dd(User::all());

        $user = User::where('user_name', $username)->where('is_active', true)->first();

        //dd($user);

        if ($user && $password === $user->password) {
            // if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            User::findOrFail($user->id)->update(['last_login_time' => Carbon::now(), 'last_login_ip' => request()->ip()]);
            Session::put('login_id', $user->id);
            Session::put('role_id', $user->role_id);

            return redirect()->intended('dashboard');
        }

        return redirect()->route('login')->with('errorcredentials', 'Credentials do not match or Account not active!');
    }

    public function logout()
    {
        $user = User::findOrFail(Auth::id());
        Auth::logout();

        return redirect()->route('login');
    }
}
