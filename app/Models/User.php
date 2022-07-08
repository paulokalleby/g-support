<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UuidTrait;

    public $incrementing = false;
    protected $keyType   = 'uuid';

    protected $fillable = [
        'locality_id',
        'department_id',
        'name',
        'email',
        'cell',
        'password',
        'technician',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'department', 
        'locality'
    ];

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }


    public function locality()
    {
        return $this->belongsTo(\App\Models\Locality::class);
    }


    public function calleds()
    {
        return $this->hasMany(Called::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class); //PIVÔ : 'permission_user'
    }
    
    public function hasPermission(string $permission)
    {
        return $this->permissions()->where('slug', $permission)->first() ? true : false;
    }

    public function isSuperAdmin()
    {
        return in_array($this->email, config('acl.admins'));
    }
}
