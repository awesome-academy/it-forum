<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{
    use SoftDeletes;

    protected $table = 'codes';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'codename',
        'html',
        'css',
        'javascript',
        'php',
        'isphp',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function saveCode($input)
    {
        $code = new code($input);
        $code->save();

        return $code;
    }

    public function updateCode($input, $id)
    {
        $code = code::find($id);
        $input['tags'] = json_encode($input['tag']);
        $code->update($input);

        return $code;
    }
}
