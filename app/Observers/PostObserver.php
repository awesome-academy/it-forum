<?php

namespace App\Observers;

use App\Notifications\NewPost;
use App\Post;
use App\User;

class PostObserver
{
    public function created(Post $post)
    {
        $follower = $post->user->follows;

        foreach ($follower as $er) {
            $er->user->notify(new NewPost($post));
        }
    }
}
