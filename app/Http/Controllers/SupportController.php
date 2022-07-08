<?php

namespace App\Http\Controllers;

use App\Http\Repositories\SupportRepository;
use App\Http\Requests\SupportRequest;
use App\Http\Resources\SupportResource;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;
    
    public function __construct(SupportRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    }
    
    public function index(Request $request)
    {     
        return SupportResource::collection(
            $this->repository->getCalleds(
                (array) $request->all()
            )
        );
    }

    public function show($id)
    {     
        return new SupportResource(
            $this->repository->getSupportById($id)
        );
    }

    public function store(SupportRequest $request)
    {     
        return new SupportResource(
            $this->repository->createNewSupport(
                (array) $request->validated()
            )
        );
    }

}
