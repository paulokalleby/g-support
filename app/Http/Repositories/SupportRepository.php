<?php

namespace App\Http\Repositories;

use App\Models\Called;
use App\Traits\UserAuthTrait;

class SupportRepository
{
    use UserAuthTrait;
    
    protected $entity;
    
    public function __construct(Called $model)
    {
        $this->entity = $model;
    }

    public function getCalleds(array $filters = [])
    {

        return $this->entity
                    ->where('requester_id', $this->loggedUser()->id)
                    ->where( function ($query) use ($filters) {

                        if(isset($filters['active'])) {
                            $query->whereActive($filters['active']);
                        } else {
                            $query->whereActive(1);
                        }

                        if(isset($filters['title'])) {
                            $title = $filters['title'];
                            $query->where('title','LIKE', "%{$title}%");
                        }

                    })
                    //->orderByDesc('updated_at')
                    ->paginate();
    }

    public function getSupportById($id): Called
    {
        return $this->entity->findOrFail($id);
    }

    public function createNewSupport(array $data): Called
    {
        $data['identify']     = $this->getIdentify();
        $data['requester_id'] = $this->loggedUser()->id;
        $data['status']       = 'pending';

        $support = $this->entity->create($data);

        $support->timelines()->create([
            'label' => 'Aberto',
            'icon'  => 'fa-comment-alt',
            'color' => 'warning', 
        ]);

        return $support;
    }


    public function getIdentify()
    {
        return ( $this->entity->count() + 1 );
    }

}