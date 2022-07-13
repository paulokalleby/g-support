<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $keyType   = 'uuid';

    protected $fillable = [
        'called_id',
        'label',
        'icon',
        'color',
        'created_at',
    ];

    /*
    public function getCreatedAtAttribute($attr)
    {
        return Carbon::make($attr)->format('d/m/Y H:i:s');
    }
    */

    public function called()
    {
        return $this->belongsTo(\App\Models\Called::class);
    }


}
