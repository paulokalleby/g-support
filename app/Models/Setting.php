<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType   = 'uuid';

    protected $fillable = [
        'name',
        'logo',
        'cell',
    ];
}
