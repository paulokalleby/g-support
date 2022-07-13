<?php

namespace App\Models;

use App\Traits\Supportable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Called extends Model
{
    use HasFactory, UuidTrait, Supportable;

    public $incrementing = false;
    protected $keyType   = 'uuid';

    protected $fillable = [
        'category_id',
        'requester_id',
        'attendance_id',
        'identify',
        'title',
        'problem',
        'solution',
        'status',
        'active',
    ];

    /*
    protected $with = [
        'user', 
        'category'
    ];
    */

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function requester()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function attendance()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function timelines()
    {
        return $this->hasMany(\App\Models\Timeline::class);
    }
}
