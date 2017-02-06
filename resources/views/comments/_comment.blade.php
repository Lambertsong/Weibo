<li>
    <a href="{{ route('users.show', $comment->user->id) }}">{{ $comment->user->name }}</a>: <span class="comment-content">{!! $comment->content !!}</span>
</li>