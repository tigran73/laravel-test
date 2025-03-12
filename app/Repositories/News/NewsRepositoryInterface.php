<?php


namespace App\Repositories\News;


interface NewsRepositoryInterface
{
    public function paginate(int $count);

    public function findWith(int $id);
}
