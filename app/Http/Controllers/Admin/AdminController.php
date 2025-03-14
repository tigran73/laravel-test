<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        $topNews = $this->newsRepository->topViews(5);
        $topAuthors = $this->newsRepository->topAuthors(5);

        return view('admin.home', [
            'topNews' => $topNews,
            'topAuthors' => $topAuthors,
        ]);
    }
}
