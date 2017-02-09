<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Status;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'content' => 'required|max:100'
        ]);

        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->status_id = $request->input('status');

        $this->authorize('store', $comment);
        Auth::user()->comments()->save($comment);

        session()->flash('success', '评论成功！');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('destroy', $comment);
        $comment->delete();
        session()->flash('success', '删除评论成功');
        return redirect()->back();
    }
}
