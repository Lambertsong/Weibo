<li>
    <span onmouseover="showUserInfo(this, '{{ $user->id }}')">
        <img src="{{ $user->avatar() }}?width=50" alt="{{ $user->name }}" class="gravatar">
    </span>
    <span class="username">
        {{ $user->name }}
        @can('destroy', $user)
            <form action="{{ route('users.destroy', $user->id) }}" method="post">
            {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
        </form>
        @endcan
        @if ($user->id !== Auth::user()->id)
            @if (Auth::user()->isFollowing($user->id))
                <form action="{{ route('followers.destroy', $user->id) }}" method="post">
                {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-sm">取消关注</button>
            </form>
            @else
                <form action="{{ route('followers.store', $user->id) }}" method="post">
                {{ csrf_field() }}
                    <button type="submit" class="btn btn-sm btn-primary">关注</button>
            </form>
            @endif
        @endif
        <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='{{ route('users.show', $user->id) }}'">主页</button>
    </span>
</li>