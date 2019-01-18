<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPost extends Notification implements ShouldQueue
{
    use Queueable;

    protected $post;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
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
            'target_id' => $this->post->id,
            'post_name' => $this->post->title,
            'target_name' => $this->post->user->username,
            'content' => 'alert.notify.posted',
            'contentI18n' => __(
                'alert.notify.posted',
                [
                    'following' => $this->post->user->username,
                    'post' => $this->post->title,
                ]
            ),
            'title' => 'page.post.newPost',
            'titleI18n' => __('page.post.newPost'),
            'type' => 'post',
            'time_from_now' => time_from_now(now()),
        ];
    }
}
