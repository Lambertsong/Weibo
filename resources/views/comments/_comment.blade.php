<li class="comment-operation">
    <a href="{{ route('users.show', $comment->user->id) }}" onmouseover="showUserInfo(this, '{{ $comment->user->id }}')">{{ $comment->user->name }}</a>:
    <span class="comment-content">{!! $comment->content !!}</span>
    @can('destroy', $comment)
        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" id="comment-{{ $comment->id }}-delete">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <i class="fa fa-trash" aria-hidden="true" onclick="submitForm('comment-{{ $comment->id }}-delete', '确定要删除这条动态码？')"></i>
        </form>
    @endcan
</li>