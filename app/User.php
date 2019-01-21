<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'email_verified_at',
        'password',
        'fullname',
        'image_path',
        'phone',
        'birthday',
        'gender',
        'address',
        'status',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function codes()
    {
        return $this->hasMany('App\Code');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function follows()
    {
        return $this->morphMany('App\Follow', 'followable');
    }

    public function socialAccount()
    {
        return $this->hasOne('App\SocialAccount');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->posts()->delete();
            $user->answers()->delete();
            $user->replies()->delete();
            $user->votes()->delete();
            $user->notifications()->delete();
            $user->codes()->delete();
            $user->reports()->delete();
            $user->follows()->delete();
            $user->socialAccount()->delete();
        });
    }
}
