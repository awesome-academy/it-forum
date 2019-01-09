<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'total_vote',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
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
        static::deleting(function ($answer) {
            $answer->replies()->delete();
            $answer->votes()->delete();
        });
    }
}
