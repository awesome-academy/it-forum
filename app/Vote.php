<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'voteable_type',
        'voteable_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function voteable()
    {
        return $this->morphTo();
    }
}
