<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Status;
use Auth;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $statuses = $user->statuses()->orderBy('created_at', 'desc')->paginate(20);
        return view('statuses/index', compact('user', 'statuses'));
    }

    public function show($id)
    {
        $status = Status::findOrFail($id);
        $user = Auth::user();
        return view('statuses/show', compact('user', 'status'));
    }

    public function create()
    {
        return view('statuses/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:500'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request->input('content')
        ]);
        return redirect()->back();
    }

    public function edit($id)
    {
        $status = Status::findOrFail($id);
        return view('statuses/create', compact('status'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|max:500'
        ]);

        $status = Status::findOrFail($id);
        $status->content = $request->input('content');
        $status->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }
}
