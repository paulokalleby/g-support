<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    protected $repository;
    
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }
    
    public function index()
    {     
        return CategoryResource::collection(
            $this->repository->getCategories()
        );
    }
}
