<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'notification_content_id',
        'user_id',
        'target_id',
        'post_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function notificationContent()
    {
        return $this->belongsTo('App\NotificationContent', 'notification_content_id');
    }
}
