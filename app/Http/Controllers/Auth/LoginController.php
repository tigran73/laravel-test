<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()){
            return redirect()->route('news');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['login', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->route('news');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
