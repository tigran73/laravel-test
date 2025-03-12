<?php


namespace App\Repositories\News;


interface NewsRepositoryInterface
{
    public function paginate(int $count, int $page = 1);

    public function findWith(int $id);
}
