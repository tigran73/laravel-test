<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        return view('admin.user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = $this->roleRepository->all();
        return view('admin.user.edit', ['edit' => 0, 'user' => new User(), 'roles' => $roles]);
    }

    public function edit(User $user)
    {
        $roles = $this->roleRepository->all();
        return view('admin.user.edit', ['edit' => 1, 'user' => $user, 'roles' => $roles]);
    }

    public function show(User $user)
    {
        return view('admin.user.show', ['user' => $user]);
    }

    public function store(StoreUserRequest $storeUserRequest)
    {
        $user = $this->userRepository->create($storeUserRequest->validated());

        $user->roles()->sync($storeUserRequest->validated('roles'));

        return redirect()->route('users.index')->with('success', 'User created!');
    }

    public function update(UpdateUserRequest $updateUserRequest, User $user)
    {
        $user = $this->userRepository->find($user->id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found!');
        }

        $user->roles()->sync($updateUserRequest->validated('roles'));

        $user->fill([
            'password' => Hash::make($updateUserRequest->password),
        ]);

        $user->save();

        return redirect()->route('users.index')->with('success', 'Password changed!');
    }

    public function destroy($user)
    {
        $user = $this->userRepository->find($user);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found!');
        }

        $this->userRepository->delete($user->id);

        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
