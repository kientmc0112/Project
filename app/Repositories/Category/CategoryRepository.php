<?php

namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function getCategoryByName()
    {

    }
}
