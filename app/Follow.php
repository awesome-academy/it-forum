<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'user_id',
        'followable_type',
        'followable_id',
    ];

    public function followable()
    {
        return $this->morphTo();
    }
}
