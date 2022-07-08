<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait Supportable 
{

    protected static function bootSupportable()
    {
        if (Auth::check() && Auth::user()->technician != 1) {

            static::creating(function (Model $model) {

                $model->requester_id = Auth::user()->id;
            
            });

            static::addGlobalScope('requester_id', function (Builder $builder) {
            
                $builder->where('requester_id', Auth::user()->id);
            
            });
        
        }
    }

}