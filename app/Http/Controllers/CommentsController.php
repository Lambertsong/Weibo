<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

        Auth::user()->comments()->create([
            'content' => $request->input('content'),
            'status_id' => $request->input('status')
        ]);

        session()->flash('success', '评论成功！');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        session()->flash('success', '删除评论成功');
        return redirect()->back();
    }
}
