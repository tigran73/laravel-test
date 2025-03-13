<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    protected UserRepositoryInterface $userRepository;
    protected NewsRepositoryInterface $newsRepository;

    public function __construct(UserRepositoryInterface $userRepository, NewsRepositoryInterface $newsRepository)
    {
        $this->userRepository = $userRepository;
        $this->newsRepository = $newsRepository;
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


    public function addNews()
    {
        return view('account.add-news');
    }

    public function storeNews(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,png,webp', 'max:5120'],
        ]);


        $file = $request->file('image');
        $path = $file->store('newsImage', 'newsImage');


        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['image'] = $path;
        $data['author'] = \Auth::id();
        $data['created_at'] = now();

        $news = $this->newsRepository->create($data);


        return redirect()->route('addNews')->with('success', 'News added!');
    }
}
