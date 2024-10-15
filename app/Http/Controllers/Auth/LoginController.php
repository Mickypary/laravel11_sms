<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public $username = '';

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $loginValue = $request->identity;

        $this->username = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->validate([
            'identity' => 'required|string',
            'password' => 'required|string',
        ]);


        $credentials = [
            $this->username => $request->identity,
            'password' => $request->password,
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('dashboard')->with('info', 'Welcome back ');
        } else {
            return redirect()->route('login')->with('error', 'Invalid Email or password');
        }
    }


    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('login')->with('success', ':) Bye. Login again when you are ready');
    }
}
