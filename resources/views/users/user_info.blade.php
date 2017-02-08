<div class="popover right popover-namecard popover_class_0" style="display: none; top: -13px; left: 68px;">
    <div class="arrow" style="top: 43px;"></div>
    <div class="popover-content">
        <div class="popover-up">
            <div class="popover-avatar">
                <a href="{{ route('users.show', $user->id) }}">
                    <img src="{{ $user->avatar() }}" alt="{{ $user->name }}">
                </a>
            </div>
            <div class="popover-info">
                <div class="username">
                    {{ $user->name }}
                </div>
                <div class="popover-status">
                    <span>
                        <a href="{{ route('users.followings', $user->id) }}">
                            关注
                        </a>
                        <strong id="following" class="stat">
                            {{ count($user->followings) }}
                        </strong>
                    </span>
                    <span>
                        <a href="{{ route('users.followers', $user->id) }}">
                            粉丝
                        </a>
                        <strong id="followers" class="stat">
                            {{ count($user->followers) }}
                        </strong>
                    </span>
                    <span>
                        <a href="{{ route('users.show', $user->id) }}">
                            微博
                        </a>
                        <strong id="statuses" class="stat">
                            {{ $user->statuses()->count() }}
                        </strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="popover-down">
                @if ($user->id !== Auth::user()->id)
                    @if (Auth::user()->isFollowing($user->id))
                        <span class="button">
                            <form action="{{ route('followers.destroy', $user->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-info btn-sm">取消关注</button>
                            </form>
                        </span>
                    @else
                        <span class="button">
                            <form action="{{ route('followers.store', $user->id) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-info btn-sm">关注</button>
                            </form>
                        </span>
                    @endif
                @endif
            <span class="button">
                <button type="button" class="btn btn-primary btn-sm" onclick="hideUserInfo()">隐藏信息框</button>
            </span>
        </div>
    </div>
</div>