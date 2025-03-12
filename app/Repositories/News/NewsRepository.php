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
}
