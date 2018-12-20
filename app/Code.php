<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'codename',
        'html',
        'javascript',
        'css',
        'php',
        'isphp',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
