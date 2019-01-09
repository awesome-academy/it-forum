<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'image_path',
        'status',
    ];

    public function posts()
    {
        return $this->belongsToMany('App\Post', 'posts_tags')->withTimestamps();
    }

    public function follows()
    {
        return $this->morphMany('App\Follow', 'followable');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($tag) {
            $tag->follows()->delete();
            $tag->posts()->detach();
        });
    }
}
