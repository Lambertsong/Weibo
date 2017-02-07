<li id="status-{{ $status->id }}">
    <a href="{{ route('users.show', $user->id )}}">
        <img src="{{ $user->avatar() }}" alt="{{ $user->name }}" class="gravatar"/>
    </a>
    <span class="user">
        <a href="{{ route('users.show', $user->id )}}">{{ $user->name }}</a>
    </span>

    <span class="contents">{!! $status->content !!}</span>
    @can('destroy', $status)
        <form action="{{ route('status.destroy', $status->id) }}" method="POST" id="status-{{ $status->id }}-delete">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="button" class="btn btn-sm btn-danger status-delete-btn" onclick="submitForm('status-{{ $status->id }}-delete', '确定要删除这条动态码？')">删除</button>
        </form>
    @endcan
    <span class="timestamp">
        {{ $status->created_at->diffForHumans() }}
    </span>
    <span class="comment">
        <span onclick="insertCommentForm(this.id)" id="comment-{{ $status->id }}">
            <i class="fa fa-commenting" aria-hidden="true"></i> 发表评论
        </span>
        <form action="{{ route('comment.store') }}" method="POST" style="display: none;" id="comment-form-{{ $status->id }}">
            @include('shared.errors')
            {{csrf_field()}}
            <input type="hidden" name="status" value="{{ $status->id }}">
            <textarea class="form-control comment-form" rows="3" name="content" id="content">{{ old('content') }}</textarea>
            <button type="submit" class="btn btn-primary">发布评论</button>
        </form>
    </span>
    <span class="comments">
        <ul>
            @if($status->comments)
                @foreach($status->comments as $comment)
                    @include('comments._comment', ['comment' => $comment])
                @endforeach
            @endif
        </ul>
    </span>
</li>