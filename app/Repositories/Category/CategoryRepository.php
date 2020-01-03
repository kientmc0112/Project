<?php

namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;
use App\Models\Category;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getParentCategory()
    {
        return Category::where('parent_id', 0)->orderBy('name')->get();
    }

    public function getIdCategorySameKind($id)
    {
        return Category::where('id', $id)
            ->orWhere('parent_id', $id)
            ->get('id');
    }
}
