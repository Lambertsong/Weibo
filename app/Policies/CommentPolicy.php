<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function store(User $user, Comment $comment)
    {
        // 评论的用户是否follow了动态的所有者或者是状态的所有者
        $statusOwnerId = Status::findOrFail($comment->status_id)->user_id;
        return $user->isFollowing($statusOwnerId) || $user->id === $statusOwnerId;
    }

    public function destroy(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
