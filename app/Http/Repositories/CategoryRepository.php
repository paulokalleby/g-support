<?php

namespace App\Http\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $entity;
    
    public function __construct(Category $model)
    {
        $this->entity = $model;
    }

    public function getCategories()
    {
        return $this->entity
                        ->whereActive(1)
                        ->orderBy('name')
                        ->get();

    }


}