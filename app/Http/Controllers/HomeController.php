<?php

namespace App\Http\Controllers;

use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index(Request $request)
    {

        $page = $request->query('page') ?? 1;

        $news = $this->newsRepository->paginate(4, $page);


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

            if (\Str::startsWith($item->image, 'newsImage/')){
                $item->image_link = asset('storage/'.$item->image);
            }else{
                $item->image_link = asset('img/'.$item->image);
            }


            return $item;
        });

        return response()->json($news);
    }
}
