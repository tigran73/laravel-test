<?php


namespace App\Repositories\News;


use App\Models\News;
use App\Repositories\BaseRepository;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function paginate(int $count, int $page = 1)
    {
        return $this->model->orderBy('updated_at', 'DESC')->paginate($count, ['*'], 'page', $page);
    }


    public function findWith(int $id)
    {
        return $this->model->with(['authorUser'])
                            ->find($id);
    }

    public function topViews(int $count)
    {
        return $this->model->orderBy('views', 'DESC')->limit($count)->get();
    }

    public function topAuthors(int $count)
    {
        return $this->model
            ->select('author', \DB::raw('COUNT(*) as news_count'))
            ->groupBy('author')
            ->orderByDesc('news_count')
            ->limit($count)
            ->get();
    }
}
