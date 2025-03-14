<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Resources\AdminNewsResource;
use App\Models\News;
use App\Repositories\News\NewsRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NewsController extends Controller
{
    protected NewsRepositoryInterface $newsRepository;
    protected UserRepositoryInterface $userRepository;

    public function __construct(NewsRepositoryInterface $newsRepository, UserRepositoryInterface $userRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $page = $request->query('page') ?? 1;

        $news = $this->newsRepository->paginate(5, $page);
        return view('admin.news.index', ['news' => $news]);
    }

    public function paginate(int $page, int $count){

        $news = $this->newsRepository->paginate($count, $page);

        $news->getCollection()->transform(function ($item) {
            $item->link_show = route('news.show', $item->id);
            $item->link_edit = route('news.edit', $item->id);
            $item->link_delete = route('news.destroy', $item->id);
            return $item;
        });

        return response()->json(['news' => AdminNewsResource::collection($news), 'csrf' => csrf_token()]);
    }

    public function create()
    {
        $users = $this->userRepository->all();
        return view('admin.news.edit', ['edit' => 0, 'news' => new News(), 'users' => $users]);
    }

    public function edit(News $news)
    {
        $users = $this->userRepository->all();
        return view('admin.news.edit', ['edit' => 1, 'news' => $news, 'users' => $users]);
    }

    public function show(News $news)
    {
        return view('admin.news.show', ['news' => $news]);
    }

    public function store(StoreNewsRequest $storeNewsRequest)
    {
        $data = $storeNewsRequest->only(['name', 'description']);

        $path = $storeNewsRequest->file('image')->store('newsImage', 'newsImage');
        $data['image'] = $path;

        if ($storeNewsRequest->has('author') && Auth::user()->hasRole('admin')){
            $data['author'] = $storeNewsRequest->author;
        }else{
            $data['author'] = Auth::user()->id;
        }

        $this->newsRepository->create($data);

        return redirect()->route('news.index')->with('success', 'News created!');
    }

    public function update(UpdateNewsRequest $updateNewsRequest, News $news)
    {
        $news = $this->newsRepository->find($news->id);

        if (!$news) {
            return redirect()->route('news.index')->with('error', 'News not found!');
        }

        $data = $updateNewsRequest->only(['name', 'description']);

        if ($updateNewsRequest->hasFile('image')) {
            $path = $updateNewsRequest->file('image')->store('newsImage', 'newsImage');
            $data['image'] = $path;
        }

        if ($updateNewsRequest->has('author') && Auth::user()->hasRole('admin')){
            $data['author'] = $updateNewsRequest->author;
        }

        $news->fill($data);

        $news->save();

        return redirect()->route('news.index')->with('success', 'Password changed!');
    }

    public function destroy($news)
    {
        $news = $this->newsRepository->find($news);

        if (!$news) {
            return redirect()->route('news.index')->with('error', 'News not found!');
        }

        $this->newsRepository->delete($news->id);

        return redirect()->route('news.index')->with('success', 'News deleted!');
    }
}
