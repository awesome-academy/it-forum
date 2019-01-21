<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'best_answer_id',
        'total_vote',
        'total_answer',
        'total_view',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'posts_tags')->withTimestamps();
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function replies()
    {
        return $this->morphMany('App\Reply', 'repliable');
    }

    public function votes()
    {
        return $this->morphMany('App\Vote', 'voteable');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($post) {
            $post->reports()->delete();
            $post->answers()->delete();
            $post->replies()->delete();
            $post->votes()->delete();
            $post->tags()->detach();
        });
    }
}
