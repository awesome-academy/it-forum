<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'status',
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($role) {
            $role->users()->delete();
        });
    }
}
