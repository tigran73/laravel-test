<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registrationForm()
    {
        if (Auth::check()){
            return redirect()->route('news');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','confirmed'],
        ]);

        User::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
}
