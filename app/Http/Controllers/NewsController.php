<?php

namespace App\Http\Controllers;

use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        $news = $this->newsRepository->paginate(4);

        //dd($news);

        return view('news', [
            'news' => $news
        ]);
    }

    public function detail(int $id)
    {
        $post = $this->newsRepository->findWith($id);

        if (!$post){
            return redirect()->route('news');
        }



        return view('news.detail', [
            'post' => $post
        ]);
    }
}
