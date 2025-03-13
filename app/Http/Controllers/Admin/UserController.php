<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        return view('admin.user.index', ['users' => $users ]);
    }

    public function create()
    {
        return view('admin.user.edit', ['edit' => 0, 'user' => new User()]);
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', ['edit' => 1, 'user' => $user]);
    }

    public function show(User $user)
    {
        return view('admin.user.show', ['user' => $user]);
    }

    public function store(StoreUserRequest $storeUserRequest)
    {
        $this->userRepository->create($storeUserRequest->validated());

        return redirect()->route('users.index')->with('success', 'User created!');
    }

    public function update(UpdateUserRequest $updateUserRequest, User $user)
    {
        $user = $this->userRepository->find($user->id);

        if (!$user){
            return redirect()->route('users.index')->with('error', 'User not found!');
        }

        $user->fill([
            'password' => Hash::make($updateUserRequest->password),
        ]);

        $user->save();

        return redirect()->route('users.index')->with('success', 'Password changed!');
    }

    public function destroy($user)
    {
        $user = $this->userRepository->find($user);

        if (!$user){
            return redirect()->route('users.index')->with('error', 'User not found!');
        }

        $this->userRepository->delete($user->id);

        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
