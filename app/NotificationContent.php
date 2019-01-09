<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationContent extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'type',
        'content_vi',
        'content_en',
        'status',
    ];

    public function notifications()
    {
        return $this->hasMany('App\Notification', 'notification_content_id');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($notificationContent) {
            $notificationContent->notifications()->delete();
        });
    }
}
