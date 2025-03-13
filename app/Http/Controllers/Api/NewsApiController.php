<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiNewsResource;
use App\Repositories\News\NewsRepositoryInterface;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{
    protected NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index(Request $request)
    {
        $page = $request->query('page') ?? 1;
        $per_page = $request->query('per_page') ?? 5;

        $news = $this->newsRepository->paginateWith($per_page, $page);

        if (!$news) {
            return response()->json(['messsge' => 'News not found!'], 404);
        }

        return response()->json(ApiNewsResource::collection($news));
    }

    public function show($id)
    {
        $post = $this->newsRepository->findWith($id);

        if (!$post) {
            return response()->json(['messsge' => 'Post not found!'], 404);
        }

        return response()->json(new ApiNewsResource($post));
    }
}
