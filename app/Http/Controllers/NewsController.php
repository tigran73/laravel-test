<?php

namespace App\Http\Controllers;

use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected NewsRepositoryInterface $newsRepository;

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

    public function newsAjax(int $page, int $count)
    {
        $news = $this->newsRepository->paginate($count, $page);

        $news->getCollection()->transform(function ($item) {


            if ($item->updated_at) $item->updated_at_formatted = $item->updated_at->format('d.m.Y H:i');

            $item->created_at_formatted = $item->updated_at->format('d.m.Y H:i');

            $item->link = route('news.detail', ['id' => $item->id]);
            $item->image_link = asset('img/'.$item->image);

            return $item;
        });

        return response()->json($news);
    }
}
