<ul class="comments-list js-comments-list newComment">
    <li class="comment js-comment">
        <div class="js-comment-actions comment-actions">
        </div>
        <div class="comment-text js-comment-text-and-form">
            <div class="comment-body">
                <span class="comment-copy">{{ $postReply->content }}</span>
                –&nbsp;
                <a href="{{ route('home.user.detail', Auth::user()->id) }}" class="comment-user">{{ Auth::user()->username }}</a>
                <span class="comment-date">
                    <a class="comment-link">
                        <span class="relativetime-clean">{{ time_from_now($postReply->created_at) }}</span>
                    </a>
                </span>
            </div>
        </div>
    </li>
</ul>
