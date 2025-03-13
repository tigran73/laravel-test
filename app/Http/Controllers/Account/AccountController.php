<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('account.home');
    }

    public function password()
    {
        return view('account.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8','confirmed'],
        ]);

        $user = $this->userRepository->find(\Auth::id());

        if (!$user){
            return redirect()->route('password')->with('error', 'User not found!');
        }

        $user->fill([
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        return redirect()->route('password')->with('success', 'Password changed!');
    }
}
