<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserFollowed extends Notification implements ShouldQueue
{
    use Queueable;

    protected $follower;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'target_id' => $this->follower->id,
            'target_name' => $this->follower->username,
            'content' => 'alert.notify.followed',
            'contentI18n' => __('alert.notify.followed', ['follower' => $this->follower->username]),
            'title' => 'page.user.follow',
            'titleI18n' => __('page.user.follow'),
            'type' => 'user',
            'time_from_now' => time_from_now(now()),
        ];
    }
}
